<?php
/**
 * Yardımcı Sınıf
 *
 * @version 1.0
 * @author Bahadir BT
 */
require_once 'classes/class.upload.php';
require_once 'BEncoding.php';

class BFunctions
{
    public $encoding;
    function __construct()  {
        $this->encoding = new BEncoding();
    }

    public function GET_EXCHANGE_RATE($KUR_TIPI, $ACIKLAMAYI_OKU = 'EĞER PARA YURTDIŞI BANKA HESABI İLE TRANSFER İSE "ForexSelling" VE "ForexBuying" ALANLARI KULLANILACAK, YURT İÇİNDE BANKNOT OLARAK ALINACAK VEYA VERİLECEK İSE "BanknoteSelling" VE "BanknoteBuying" ALANLARI KULLANILACAK'){

        $DOVIZ_KURU = array();
        $adres = "http://www.tcmb.gov.tr/kurlar/today.xml";
        $xml_data = simplexml_load_file($adres);
        foreach($xml_data->Currency as $Currency){
            if($Currency['Kod'] == $KUR_TIPI){
                $ForexSelling = (string)$Currency->ForexSelling;
                $ForexBuying = (string)$Currency->ForexBuying;
                //$BanknoteSelling = (string)$Currency->BanknoteSelling;
                //$BanknoteBuying = (string)$Currency->BanknoteBuying;
                $DOVIZ_KURU = array('TIP'=>$KUR_TIPI,'SATIS'=> $ForexSelling,'ALIS'=>$ForexBuying);
            }
        }
        return $DOVIZ_KURU;
    }

    public function post($par, $encode = false){
        if($encode){
            return $this->encoding->STR_UTF8_TO_MSSQL($_POST[$par]);
        }else{
            return $this->encoding->STR_UTF8_TO_MSSQL(addslashes(trim(htmlentities($_POST[$par]))));
        }
    }

    public function get($par, $st=false){
        if($st){
            return htmlspecialchars(addslashes(trim(htmlentities($_GET[$par]))));
        }else{
            return addslashes(trim(htmlentities($_GET[$par])));
        }
    }

    public function CONVERT_POSTED_FILE_TO_BINARY($POSTED_FILE){
        if ( 0 < $POSTED_FILE['error'] ) {
            return 'Error: ' . $POSTED_FILE['error'] . '<br>';
        } else {

            $FILE_NAME = $POSTED_FILE['name'];
            $TMP_NAME  = $POSTED_FILE['tmp_name'];
            $FILE_SIZE = $POSTED_FILE['size'];
            $FILE_TYPE = $POSTED_FILE['type'];
            $DATA_STRING = file_get_contents($TMP_NAME);
            $DATA = unpack("H*hex", $DATA_STRING);
            $BINARY = "0x".$DATA['hex'];
            return $BINARY;
        }
    }

    public function IN_ARRAY_R($Aranan, $Array, $strict = false) {
        foreach ($Array as $item) {
            if (($strict ? $item === $Aranan : $item == $Aranan) || (is_array($item) && $this->in_array_r($Aranan, $item, $strict))) {
                return true;
            }
        }
        return false;
    }

    public function unsetValue(array $array, $value, $strict = TRUE)
    {
        if(($key = array_search($value, $array, $strict)) !== FALSE) {
            unset($array[$key]);
        }
        return $array;
    }

    public function ResimYukle($input_name, $x, $y, $db_table_name, $image_resize = false, $image_ratio_crop = false, $directory_level = 1)
    {
        $resim="";
        $upload = new upload($_FILES[$input_name]);
        if ($upload->uploaded){
            $upload->upload_max_filesize = bahadir::$MaxUploadFileSize;
            $upload->post_max_size = bahadir::$MaxUploadFileSize;
            $upload->file_dst_name_body   = $db_table_name;
            $upload->image_resize         = $image_resize;

            if($x != 0){
                $upload->image_x = $x;
            }else{
                $upload->image_ratio_x = true;
            }

            if($y != 0){
                $upload->image_y = $y;
            }else{
                $upload->image_ratio_y = true;
            }

            $upload->image_ratio_crop = $image_ratio_crop;
            $upload->file_auto_rename = true;
            if($directory_level == 1){
                $upload->process('../uploads/images/'.$db_table_name);
            }else
            {
                $upload->process('../../uploads/images/'.$db_table_name);
            }

            if ($upload->processed){
                $resim = $upload->file_dst_name;
            }
        }
        return $resim;
    }

    public function textOverflow($Text, $MaxLenght )
    {
        $max_length = $MaxLenght;
        if (strlen($Text) > $max_length)
        {
            $offset = ($max_length - 3) - strlen($Text);
            $Text = substr($Text, 0, strrpos($Text, ' ', $offset)) . '...';
        }
        return $Text;
    }

    public function strtoupperTR($str)
    {
        $upperTR = mb_convert_case(str_replace(array(“i”,”ı”),array(“İ”,”I”),$str), MB_CASE_UPPER, "UTF-8");
        return strtoupper($upperTR);
    }

    public function turkceTarih ($tarih, $dbh, $language_id) {
        date_default_timezone_set('Europe/Istanbul');

        $gunler = array('Pazar','Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi');
        $aylar = array('','Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık');

        $tarih = strtotime($tarih);
        $gun = $dbh->Cevirmen($gunler[date('n',$tarih)], $language_id);
        $ay = $dbh->Cevirmen($aylar[date('n',$tarih)], $language_id);


        return date('d',$tarih).' '.$ay.' '.date('Y',$tarih);
    }

    public function turkce_karakter_temizle($tr1) {
        $turkce=array("ş","Ş","ı","ü","Ü","ö","Ö","ç","Ç","ş","Ş","ı","ğ","Ğ","İ","ö","Ö","Ç","ç","ü","Ü");
        $duzgun=array("s","S","i","u","U","o","O","c","C","s","S","i","g","G","I","o","O","C","c","u","U");
        $tr1=str_replace($turkce,$duzgun,$tr1);
        $tr1 = preg_replace("@[^a-z0-9\-_şıüğçİŞĞÜÇ]+@i","-",$tr1);
        return $tr1;
    }

    public function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}