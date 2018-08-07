<?php

namespace RRPhpLibraryV2;

use RRPhpLibraryV2\Helpers\PhpCrud as PhpCrud;

class RRPhpLibrary{
    public $pCrud;
    
    function __construct(PhpCrud $pCrud) {
        
        //$this->pCrud = $pCrud;
        $this->pCrud = $pCrud;//PhpCrud::getInstance();
        //$this->pCrud = new PhpCrud;
        echo "Initializing RRPhpLibrary";
    }
    
    
}

?>