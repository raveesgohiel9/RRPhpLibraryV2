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
$folder_id = $_REQUEST['folder_id'];
$folder_name  = $_REQUEST['folder_name'];
$client_code = $_REQUEST['client_code'];
$company_name = $_REQUEST['company_name'];
$fieldname = $_REQUEST['fieldname'];
$where = " WHERE ".$fieldname." = ".$id;
$con = $pCrud->connection($servername,$username,$password,$dbname);
$result = $pCrud->DeleteRowWhere($con,$tbname,$where);
//$result = $pCrud->DeleteRowWherePrint($con,$tbname,$where);
$pCrud->disconnection($con);
header('Location: '.$previous_url.'&folder_id='.$folder_id.'&folder_name='.$folder_name.'&client_code='.$client_code.'&company_name='.$company_name);

?>