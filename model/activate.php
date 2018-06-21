<?php
	/*
	*  The Activate Model file that takes in the Table name, User ID,
	*  Previous URL that the user will be redirected to.
	*/
require_once("../RRPhpLibrary/RRPhpLibrary.php");
$pCrud = new PhpCrud();

$tbname = $_REQUEST['tbname'];
$id = $_REQUEST['id'];
$previous_url = $_REQUEST['previous_url'];
$fieldname = $_REQUEST['fieldname'];
$where = "".$_REQUEST['active']."= 1 WHERE ".$fieldname." = ".$id;
$con = $pCrud->connection($servername,$username,$password,$dbname);
$fieldlist = array('');
$result = $pCrud->UpdateWhere($con,$tbname,$where);
//$result = $pCrud->UpdateWherePrint($con,$tbname,$fieldlist,$where);
header('Location: '.$previous_url);
$pCrud->disconnection($con);
?>