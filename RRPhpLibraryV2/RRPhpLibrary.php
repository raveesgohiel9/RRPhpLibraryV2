<?php

namespace RRPhpLibraryV2;

use RRPhpLibraryV2\Helpers\PhpCrud as PhpCrud;

class RRPhpLibrary{
    public $pCrud;
    
    function __construct() {
        
        //$this->pCrud = $pCrud;
        $this->pCrud = PhpCrud::getInstance();//PhpCrud::getInstance();
        //$this->pCrud = new PhpCrud;
        echo "Initializing RRPhpLibrary";
    }
    
    
}

?>