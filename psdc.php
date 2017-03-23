# Arquivos-de-Registro
Sistema de registro em php
<?php
    //--------------------------------------------------------------------------
    // PSDC - PHP Symple DB Connector, by Rodrigo G. Búrigo (Lenseth)
    //--------------------------------------------------------------------------
    // $dbopt Driver Table:
    //
    // 0 = Microsoft SQL New Driver (sqlsrv)
    // 1 = Mysql Driver
    // 2 = Postgree SQL Driver
    // 3 = Oracle Driver
    //--------------------------------------------------------------------------
    // Example:
    //
    // $conn = new Connection("12.0.0.1", "test", "root", "12345", 1337, 1);
    // $dbaccess = $conn->connect();
    //
    //--------------------------------------------------------------------------
    class Connection{
        private $dbhost = -1;
        private $dbname = -1;
        private $dbuser = -1;
        private $dbpass = -1;
        private $dbopt  = -1;
        private $dbport = -1;
        private $setcon = -1;
        public function __construct($dbhost, $dbname, $dbuser, $dbpass, $dbport, $dbopt) {
            $this->dbhost = $dbhost;
            $this->dbname = $dbname;
            $this->dbuser = $dbuser;
            $this->dbpass = $dbpass;
            $this->dbport = $dbport;
            $this->dbopt  = $dbopt;
        }
        public function connect(){
            if($this->setcon != -1){
                return $this->setcon;
            }
            try {
            	switch($this->dbopt){
            		case 0:
            		    //-- SQLSRV Connector --//
            		    $this->setcon = new PDO("sqlsrv:server={$this->dbhost}, {$this->$dbport};Database={$this->dbname}",$this->dbuser, $this->dbpass);
                	    return $this->setcon;
                	    break;
                	case 1:
                	    //-- MySQL Connector --//
            		    $this->setcon = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname};port={$this->$dbport}",$this->dbuser, $this->dbpass);
                	    return $this->setcon;
                	case 2:
                	    //-- PgSQL Connector --//
            		    $this->setcon = new PDO("pgsql:host={$this->dbhost};dbname={$this->dbname};port={$this->$dbport}",$this->dbuser, $this->dbpass);
                	    return $this->setcon;
                	    break;
                	case 3:
                	    //-- Oracle Connector --//
                	    $dboraclesrvc = "ORCL";
                	    $dboracleinfo = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$dbhost.")(PORT = ".$this->$dbport."))(CONNECT_DATA = (SERVICE_NAME = ".$dboraclesrvc.") (SID = ".$dboraclesrvc.")))";
            		    $this->setcon = new PDO("oci:dbname=".$dboracleinfo.";charset=utf8", $this->dbuser, $this->dbpass);
                	    return $this->setcon;
                	    break;
            	}
            }
            catch(Exception $e){
                exit; //-- Use "echo $e;" to output connection errors & warnings --//
            }
        }
        public function __destruct(){
            $this->setcon = NULL;
        }
    }
