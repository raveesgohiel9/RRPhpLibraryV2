<?php
	/*
	*  The Deactivate Model file that takes in the Table name, User ID,
	*  Previous URL that the user will be redirected to.
	*/
	
require_once("../RRPhpLibrary/RRPhpLibrary.php");
$pCrud = new PhpCrud();


$tbname = $_GET['tbname'];
$id = $_GET['id'];
$previous_url = $_GET['previous_url'];
$fieldname = $_GET['fieldname'];
$where = " ".$_GET['active']." = 0 WHERE ".$fieldname." = ".$id;

$con = $pCrud->connection($servername,$username,$password,$dbname);
$result = $pCrud->UpdateWhere($con,$tbname,$where);
//echo "Result-".$result;
header('Location: '.$previous_url);
$pCrud->disconnection($con);
?>