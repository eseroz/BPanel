<?php
/**
 * Yardımcı Sınıf
 *
 * @version 1.0
 * @author Bahadir BT
 */

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
            return $this->BEncoding->encoding->STR_UTF8_TO_MSSQL($_POST[$par]);
        }else{
            return $_POST[$par];
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

        $this->Audit("Logout",11,0,"panelden çıktı.");

        session_destroy();
        ob_end_flush();
        header("location:index.php");
    }
}
