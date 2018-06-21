<?php

require_once __DIR__ .'/../vendor/autoload.php';

class RRPhpLibrary{
    public $pCrud;
    
    function __construct() {
        
        //$this->pCrud = $pCrud;
        $this->pCrud = PhpCrud::getInstance();
        //$this->pCrud = new PhpCrud;
        echo "Initializing RRPhpLibrary";
    }
    
    
}

?>