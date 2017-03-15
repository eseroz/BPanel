<?php
//error_reporting(0);



require 'BDatabase.php';
require 'BFunctions.php';


$bahadir = new bahadir();

if($panel == true){
    $bahadir->OTURUM_KONTROL();
}else{
    $SETTINGS = $bahadir->GET_SITE_SETTINGS();
}


class bahadir extends PDO
{
    public $mssqlDb;
    public $fnc;

    public static $MaxUploadFileSize = 4096;

    public static $slayt_foto_x = 1920;
    public static $slayt_foto_y = 500;
    public static $slayt_foto_thumbnail_x = 290;
    public static $slayt_foto_thumbnail_y = 180;
    public static $slayt_foto_resize = false;
    public static $slayt_foto_ratio_crop = false;
    public static $slayt_foto_tablename = 'slayt';
    public static $slayt_foto_input_name = 'resim';


	function __construct()
	{
        //$mssql_host = "e-bahadir.com";
        //$mssql_database = "BAHADIR_WEB";
        //$mssql_uid = "sa";
        //$mssql_password = "bahadir956230**";

        $mssql_host = ".";
        $mssql_database = "BAHADIR_WEB";
        $mssql_uid = "sa";
        $mssql_password = "43179488**1CSHARP**1";
        $this->mssqlDb = new MSSQL_Database($mssql_host,$mssql_database,$mssql_uid,$mssql_password);
        $this->SESSION_START();
        $this->fnc = new BFunctions();
	}

    public function SESSION_START(){
		session_start();
		ob_start();
	}

	public function SESSION_FLUSH()
	{
        unset($_COOKIE['panel2016_username']);
        unset($_COOKIE['panel2016_password']);
        unset($_COOKIE['panel2016_remember']);

        setcookie('panel2016_username', null, time()-1, '/panel');
        setcookie('panel2016_password', null, time()-1, '/panel');
        setcookie('panel2016_remember', null, time()-1, '/panel');

        session_destroy();
        ob_end_flush();
        header("location:index.php");
    }

    public function OTURUM_KONTROL(){
        if($_SESSION['ON'] == "ON"){

        }else{
            header("location:login.php");
        }
    }

    public function LOGIN($username, $password, $remember){

        $username_md5 = md5(md5($username));
        $password_md5 = md5(md5($password));
        $LOGIN = $this->mssqlDb->Select("SELECT *FROM USERS WHERE USERNAME = '$username' AND PASSWORD = '$password_md5'");
        if(count($LOGIN) > 0){

            $_SESSION['ON'] = "ON";

            if ($remember == "on") {
                setcookie('BUSER_NAME', $username_md5, time()+60*60*24*365, '/panel');
                setcookie('BPASSWORD', $password_md5, time()+60*60*24*365, '/panel');
                setcookie('BREMEMBER', $remember, time()+60*60*24*365, '/panel');
            }else{
                setcookie('BUSER_NAME', null, time()-1, '/panel');
                setcookie('BPASSWORD', null, time()-1, '/panel');
                setcookie('BREMEMBER', null, time()-1, '/panel');
            }
            header("location:index.php");
        }else{
            $message = "Hatalı kullanıcı adı veya parola!";
            return $message;
        }
    }

    public function GET_SITE_SETTINGS(){
        $SETTINGS = $this->mssqlDb->Select("SELECT *FROM SITE_SETTING");
        return $SETTINGS[0];
    }

    public function TRANSLATE_WORD($kelime, $site = 0){
        return $kelime;
    }

    public function SLAYT_EKLE(){

        $baslik1 = $this->fnc->post("baslik1");
        $baslik2 = $this->fnc->post("baslik2");
        $aciklama = $this->fnc->post("aciklama");
        $gorunurluk = $this->fnc->post("gorunurluk");

        if($_FILES["resim"]){
            $IMG_BINARY = $this->fnc->CONVERT_POSTED_FILE_TO_BINARY($_FILES["resim"]);
        }else
        {
            $IMG_BINARY='';
        }


        $IMG_SVG_STRING = $this->fnc->post("txtSvgKodu");
        $content = $this->fnc->post("content");
        $seo = $this->fnc->turkce_karakter_temizle($aciklama);


        //$resim = $this->fnc->ResimYukle(self::$slayt_foto_input_name,self::$slayt_foto_x,self::$slayt_foto_y,self::$slayt_foto_tablename,self::$slayt_foto_resize,self::$slayt_foto_ratio_crop);
        //$resim_thumbnail = $this->fnc->ResimYukle(self::$slayt_foto_input_name,self::$slayt_foto_thumbnail_x,self::$slayt_foto_thumbnail_y,self::$slayt_foto_tablename,self::$slayt_foto_resize,self::$slayt_foto_ratio_crop);

        $SIRA = 0;

        $this->mssqlDb->ExexQuery("INSERT INTO SLIDER (SEQUENCE,IMAGE_BINARY,IMAGE_SVG,TITLE1,TITLE2,DESCRIPTION,CONTENT_HTML,SEO,VISIBILITY) VALUES($SIRA,$IMG_BINARY,'$IMG_SVG_STRING','$baslik1','$baslik2','$aciklama','$content','$seo','$gorunurluk')");


    }


}