<?php
//error_reporting(0);

require 'BDatabase.php';
require 'BFunctions.php';


$bahadir = new bahadir();
$bahadir->SESSION_START();

class bahadir extends PDO
{
    public $mssqlDb;
    public $functionss;

	function __construct()
	{
        $mssql_host = ".";
        $mssql_database = "BAHADIR_WEB";
        $mssql_uid = "sa";
        $mssql_password = "43179488**1CSHARP**1";
        $this->mssqlDb = new MSSQL_Database($mssql_host,$mssql_database,$mssql_uid,$mssql_password);
        $this->functionss = new BFunctions();
        $this->SESSION_START();
	}

    public function SESSION_START(){
		session_start();
		ob_start();
	}

	public function SESSION_FLUSH()
	{
        session_start();

        unset($_COOKIE['panel2016_username']);
        unset($_COOKIE['panel2016_password']);
        unset($_COOKIE['panel2016_remember']);

        setcookie('panel2016_username', null, time()-1, '/panel');
        setcookie('panel2016_password', null, time()-1, '/panel');
        setcookie('panel2016_remember', null, time()-1, '/panel');

        $this->Audit("Logout",11,0,"panelden çýktý.");

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
            header("location:login.php");
        }
    }

    public function Cevirmen($kelime, $language_id, $site = 0){
        return $kelime;
    }
}