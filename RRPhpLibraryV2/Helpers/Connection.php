<?php

namespace RRPhpLibraryV2\Helpers;

    class Connection
    {
    //Ace Success server details
        public $servername = "localhost";
        public $username = "root";
        public $password = "";
        public $dbname = "acesucce_ams_admin";

        private static $con;
            
        public function __construct()
        {
            echo "Connection construct"; 
            $dbq = mysqli_connect($this->servername,$this->username,$this->password)  or die("Cannot connect to Mysql Server");
            $db = mysqli_select_db($dbq,$this->dbname) or die("Cannot select DB");

            // Check connection
            if (mysqli_connect_errno()) {
                    //$this->display("Cannot connect");
            }
            else
            {
                    //$this->display("Connected");
            }
        }
        private function __clone() {
        // Stopping Clonning of Object
        }

        private function __wakeup() {
            // Stopping unserialization of object
        }
        static function getInstance()
        {   
            if(self::$con == null)
            {
                self::$con = new Connection();
            }
            return self::$con;
        }
    // Create connection
    //$dbh = new mysqli($servername, $username, $password);

    //$dbq = mysqli_connect($servername, $username, $password,$dbname);

    }

?>