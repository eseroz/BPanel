<?php
//error_reporting(0);

class MSSQL_Database extends PDO {

    public $mssqlCon;
    public $functions;

    function __construct($host,$database,$user,$password)  {

        ini_set("odbc.defaultlrl", "10240K");
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);

        $this->mssqlCon = odbc_connect("Driver={SQL Server};Server=$host;Database=$database;","$user","$password");
        $this->functions = new BFunctions();
    }

    public function Select($sql){
        $query = odbc_exec($this->mssqlCon, $sql);

        $i = 0;
        $rows = array();

        while($row = odbc_fetch_array( $query )){
            $rows[$i] = $row;
            $i++;
        }

        echo odbc_errormsg();
        return $this->functions->encoding->ARR_WALK_MSSQL_TO_UTF8($rows);
    }

    public function ExexQuery($sql){
        odbc_exec($this->mssqlCon, $sql);
        return odbc_errormsg();
    }

    public function IDENT_CURRENT($TABLE_NAME){
        $return = $this->Select("SELECT IDENT_CURRENT('$TABLE_NAME') AS ID");
        return $return[0]["ID"];
    }
}