<?php

    if(isset($_POST['moduleGenerated']))
    {
        $moduleName = $_POST['moduleName'];
            
        echo "Module:".$moduleName." <br />";
        
        $fname = 'controller.php';
        $fl = fopen($fname,'r');
        $content = fread($fl,  filesize($fname));
        fclose($fl);
        echo $content;
        
        echo "--------------------------";
        //Repalace text here
        $content = str_replace("<_Module_Name_>", $moduleName, $content);
        echo $content;
        echo "--------------------------";
        
        $fnameNew = '../controller/'.$moduleName.'controller.php';
        echo "FileName:".$fnameNew." <br />";
        $flNew = fopen($fnameNew,'w');
        fwrite($flNew, $content);
        fclose($flNew);
        
    }

?>

<form method="post" action="moduleGenerator.php" >
    Enter module Name:<input type="text" name="moduleName" required="true">
    <br />
    <input type="submit" name="moduleGenerated">
</form>