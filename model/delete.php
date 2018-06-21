<?php
/*
*  The Delete Model file that takes in the Table name, User ID,
*  Previous URL that the user will be redirected to.
*/
require_once("../RRPhpLibrary/RRPhpLibrary.php");
$pCrud = new PhpCrud();

$tbname = $_REQUEST['tbname'];
$id = $_REQUEST['id'];
$previous_url = $_REQUEST['previous_url'];

$fieldname = $_REQUEST['fieldname'];
$where = " WHERE ".$fieldname." = ".$id;
$con = $pCrud->connection($servername,$username,$password,$dbname);
$result = $pCrud->DeleteRowWhere($con,$tbname,$where);
//result = $pCrud->DeleteRowWherePrint($con,$tbname,$where);


$pCrud->disconnection($con);
header('Location: '.$previous_url);

?>