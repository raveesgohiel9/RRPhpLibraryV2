<?php

namespace model;

class user extends Model{
    
    /*
     * This is a class for taking care of the user.
     * This class defines as set of functions using 
     * RRPhpLibrary class and all the other functions.
     */
    
    private $tbname;
    
    public $userID;
    public $userLname;
    public $userFname;
    public $userEmail;
    
    private $RRPhpLib;
    
    public function __construct() {
        $this->RRPhpLib = new RRPhpLibrary;
    }
    
    public function __destruct() {
        
    }
    
    public function getRecord($id)
    {
        $where = " where userID=".$id;
        $fieldList = $this->RRPhpLib->pCrud->getFieldList($tbname);
        $result = $this->RRPhpLib->pCrud->SimpleSelectColumnsWhere($this->tbname,$fieldList,$where);
        print_r($result);
//return $result;
    }
    public function getRecords()
    {
        return $result = $RRPhpLib->$pCrud->SimpleSelectColumns($this->tbname,$fieldlist);
        //Format the response into an array
        
        
        
    }
    public function updateRecord($values,$where)
    {
        $where = " where userID=".$id;
        $fieldList = $this->RRPhpLib->pCrud->getFieldList($this->tbname);
        return $result = $this->RRPhpLib->pCrud->SimpleSelectColumnsWhere($this->tbname,$fieldList,$where);
    }
    
    public function __get($name) {
        echo "Get:".$name;
    }
    public function __set($name, $value) {
        echo "Set:".$name." value:".$value;
    }
    
    
}

?>
