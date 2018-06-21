<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("../RRPhpLibrary/RRPhpLibrary.php");
$pCrud = new PhpCrud();

$url = $_REQUEST['url'];

$tbname = 'customers';
$code = $_REQUEST['customer_client_code'];
$tableList = new TableList();

$fieldlist = array('customer_contact_person1','customer_email1');//$tableList->getFieldList($tbname."_all");
$where = " where customer_client_code='".$code."'";

$con = $pCrud->connection($servername,$username,$password,$dbname);

$result = $pCrud->SimpleSelectColumnsWhere($dbq, $tbname, $fieldlist,$where);
//$result = $pCrud->SimpleSelectColumnsWherePrint($con, $tbname, $fieldlist,$where);
if($result)
{
    $row = mysql_fetch_assoc($result);
    $message = '<html><body>';
    $message .= '<p align="left">Dear '.$row['customer_contact_person1'].',</p><br>';
    $message .= '<p align="left">A new invoice has been uploaded for you by Ace Success</p><br>';
    $message .= '<table width="25%">';
    $message .= '</table>';
    $message .= '<p align="left">You can login to the E-Services portal using this link http:/www.ace-success.com.sg/dashboard</p><br>';
    $message .= '<p align="left">Sincerely Yours</p><br>';
    $message .= '<p align="left">Ace Success Pte Ltd</p><br>';
    $message .= '<p align="left">Customer Care: (65) 65139221</p><br>';
    $message .= '</html></body>'; 
    $headers = "From: admin@ace-success.com.sg\r\n";
			$headers .= "Reply-To: admin@ace-success.com.sg\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    mail($row['customer_email1'],"New invoice uploaded",$message,$headers);
}

//echo "Url:".$url;
header('Location: '.$url);
$pCrud->disconnection($con);

?>