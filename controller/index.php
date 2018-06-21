<?php
	ob_start();
	session_start();
	$user_code=$_SESSION['user_code'];
	$user_type=$_SESSION['user_type'];
        $user_customer_code = $_SESSION['user_customer_code'];
	if(!isset($user_code))
	{
		header("Location: ../index.php");
	}

require_once("../RRPhpLibrary/RRPhpLibrary.php");
$pCrud = new PhpCrud();

require_once("../templates/ams/views/header.php");
require_once("../templates/ams/views/topbar.php");

?>
<!-- Start of container and row fluid -->
<div class="container-fluid-full">
	<div class="row-fluid">
	<?php
	/*
	 * Place the sidebar menu here
	 */
require_once('../templates/ams/views/menu.php');
?>
<!-- start: Content -->
<div id="content" class="span10">
	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.php">Dashboard</a> 
			<i class="icon-angle-right"></i>
		</li>
	<!--<li><a href="index.php">Dashboard</a></li>-->
</ul>
<div class="row-fluid">
<?php
/*
 * Place the content here
 */
$tableList = new TableList();
$con = $pCrud->connection($servername,$username,$password,$dbname);


 if(strcmp($user_type,"Super Admin") == 0 || strcmp($user_type,"Staff Admin") == 0 || strcmp($user_type,"Staff") == 0)
 {
    $tbname = "customer_dates";
    $fieldlist = array('customer_id','customer_client_code','customer_company_name','contract_start_date','contract_end_date','fye');//$tableList->getFieldList($tbname."_display");

    $where = " where contract_end_date between CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 30 DAY)";	
    $result = $pCrud->SimpleSelectColumnsWhere($con,$tbname,$fieldlist,$where);
    //$result = $pCrud->SimpleSelectColumnsWherePrint($con,$tbname,$fieldlist,$where);
	if($result)
	{
		echo'
		    <div class="row-fluid sortable">		
				<div class="box span9">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Contracts</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
							<thead>
							<tr>
								<th colspan = "3">Customer contracts about to end within 1 month</th>
							</tr>
							<tr>
								<th>Company</th>
								<th>Contract end date</th>
								<th>View Details</th>
							</tr>
						</thead>
						<tbody>
						';
						while($row = mysql_fetch_assoc($result))
						{
                                                    echo'
                                                    <tr>
                                                            <td>'.$row['customer_company_name'].'</td>';
                                                            $date_new = explode('-',$row['contract_end_date']);

                                                    echo'
                                                            <td>'.$date_new[2].'-'.$date_new[1].'-'.$date_new[0].'</td>
                                                            <td><a href="customerscontroller.php?id='.$row['customer_id'].'&action=Edit">Click here</a></td>
                                                    </tr>';
						}
						echo'
							</tbody>
						</table>
					</div>
				</div>
			</div>';
		}
 }
 else if(strcmp($user_type,"Customer") == 0 || strcmp($user_type,"Customer Admin") == 0)
 {
    $tbname = "customers";
    $fieldlist = array();
    $fieldlist = $tableList->getFieldList($tbname."_all");

    $where = " where customer_client_code = '".$_SESSION['user_customer_code']."'";	
    $result = $pCrud->SimpleSelectColumnsWhere($con,$tbname,$fieldlist,$where);
    //$result = $pCrud->SimpleSelectColumnsWherePrint($con,$tbname,$fieldlist,$where);
    if($result)
    {
        $row = mysql_fetch_assoc($result);
    }
    echo'
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Company Details</h2>
                <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
                <div class="box-content">
                    <table border="0" class="table table-striped table-bordered bootstrap-datatable datatable">
                    <tbody>    
                        <tr>
                            <td width="30%"><label class="control-label" for="date01">Company Name:</label></td>
                            <td>'.$_SESSION['customer_company_name'].'</td>
                            
                        </tr>
                            <td><label class="control-label" for="date01">Company UEN:</label></td>
                            <td>'.$_SESSION['user_customer_code'].'</td>
                        <tr>
                            <td><label class="control-label" for="date01">User Name</label></td>
                            <td>'.$_SESSION['user_fname'].'</td>
                        </tr>
                        <tr>
                            <td><label class="control-label" for="date01">Contract Start Date:</label></td>';
                            $startdate = explode("/",$row['customer_contract_start_date']);
                            echo'<td>'.$startdate['1'].'-'.$startdate[0].'-'.$startdate[2].'</td>
                        </tr>
                        <tr>
                            <td><label class="control-label" for="date01">Contract End Date:</label></td>';
                            $enddate = explode("/",$row['customer_contract_end_date']);
                            echo'<td>'.$enddate['1'].'-'.$enddate[0].'-'.$enddate[2].'</td>
                        </tr>
                        <tr>
                            <td><label class="control-label" for="date01">Financial Year Ending:</label></td>';
                            $fyedate = explode("/",$row['customer_fye']);
                            echo'<td>'.$fyedate['1'].'-'.$fyedate[0].'-'.$fyedate[2].'</td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td>'.$row['customer_address1'].'</td>
                        </tr>
                        <tr>
                            <td>Contact Person:</td>
                            <td>'.$row['customer_contact_person1'].'</td>
                        </tr>
                        <tr>
                            <td>Designation:</td>
                            <td>'.$row['customer_designation1'].'</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>'.$row['customer_email1'].'</td>
                        </tr>
                        <tr>
                            <td>Mobile:</td>
                            <td>'.$row['customer_mobile1'].'</td>
                        </tr>
                    </tbody>        

                    </table>
                </div>
            
        </div>
    </div>';
 }
 
if(strcmp($user_type,"Super Admin") == 0 || strcmp($user_type,"Staff Admin") == 0 || strcmp($user_type,"Staff") == 0)
 {	
    $tbname1 = 'customer_transaction_payment';
    $fieldlist1 = array();
    $fieldlist1 = $tableList->getFieldList($tbname1."_display");

    $result1 = $pCrud->SimpleSelectColumns($con,$tbname1,$fieldlist1);
    //$result1 = $pCrud->SimpleSelectColumnsPrint($con,$tbname1,$fieldlist1);
}
    else if(strcmp($user_type,"Customer") == 0 || strcmp($user_type,"Customer Admin") == 0)
{
    $tbname1 = 'customer_transaction_payment';
    $fieldlist1 = array();
    $fieldlist1 = $tableList->getFieldList($tbname1."_display");
    $where = " where customer_client_code='".$user_customer_code."'";
    $result1 = $pCrud->SimpleSelectColumnsWhere($con,$tbname1,$fieldlist1,$where);
    //$result1 = $pCrud->SimpleSelectColumnsWherePrint($con,$tbname1,$fieldlist1,$where);
}
		
	if($result1)
	{
		
				
		echo'
		    <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Payments</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
							<thead>
							<tr>';
                                                            if(strcmp($user_type,"Customer") == 0 || strcmp($user_type,"Customer Admin") == 0)
                                                            {
								echo '<th colspan = "10">All the outstanding payments and paid invoices are listed below. You can choose to pay for outstanding payments using cheque, cash or even paypal.</th>';
                                                            }
                                                            else
                                                            {
                                                                echo '<th colspan = "10">All the outstanding payments and unpaid customer invoices are listed below. </th>';
                                                            }
                                                        echo'</tr>
							<tr>
                                                            <th>ID</th>
                                                            <th>Company name</th>
                                                             <th>Invoice Num</th>
                                                             <th>Invoice Date</th>
                                                             <th>Amount</th>
                                                             <th>Paid</th>
                                                             <th>Due</th>
                                                             <th>Status</th>
                                                             <th>Invoice</th>
                                                             <th>Actions</th>
							</tr>
						</thead>
						<tbody>
						';
						$prev_invoice_num = "";
						$amount_paid = 0;
						$i = 0;
						$rowcount1 = mysql_num_rows($result1);
						
						if($rowcount1 > 0)
							{
								
								while ($row1 = mysql_fetch_assoc($result1)) 
								{
                                                                    
                                                                    //converting date here
                                                                    $newdate = date("d-m-Y", strtotime($row1['transaction_invoice_date']));
									//print_r($row1);
									$total_amt = floatval($row1['transaction_contract_amount']);
									$amt_paid = floatval($row1['amount_sum']); 
									$amt =  $total_amt - $amt_paid;
									if($amt_paid < $total_amt)
									{
										//echo "File path-".$row['transaction_invoice_file_path'];
										echo '<tr>';
                                                                                echo '<td>'.$row1['transaction_id'].'</td>';
										echo '<td>'.$row1['customer_company_name'].'</td>';
										echo '<td>'.$row1['transaction_invoice_num'].'</td>';
										//echo '<td>'.$row1['transaction_invoice_date'].'</td>';
                                                                                echo '<td>'.$newdate.'</td>';
										echo '<td>$'. money_format('%.2n',$row1['transaction_contract_amount']).'</td>';
										if($row1['amount_sum'] == null)
										{
											echo '<td>$'.money_format('%.2n',0).'</td>';
										}
										else
										{
											echo '<td>$'.money_format('%.2n',$row1['amount_sum']).'</td>';	
										}
										
										
										echo'<td>$'.money_format('%.2n',$amt).'</td>';
										if($amt_paid == $total_amt)
										{
											echo '<td style="background-color:green;color:white;">Fully Paid</td>';
										}
										else if($amt_paid > 0)
										{
											echo '<td style="background-color:yellow;">Partially Paid</td>';
										}
										else if($amt_paid == 0)
										{
											echo '<td style="background-color:red;color:white;">Not Paid</td>';
										}
										/*for($j=5; $j < count($fieldlist) - 1; $j++) 
										{
												
											echo "<td>".$row[$fieldlist[$j]]."</td>";
												
										}*/
										
										if($row1['transaction_invoice_file_path']!=null)
										{
											echo '
												<td><a target="blank" href="'.$row1['transaction_invoice_file_path'].'">View Invoice</a></td>
											';
										}
										else
										{
											echo '<td>No invoice</td>';
										}
										if(strcmp($user_type,"Super Admin") == 0 || strcmp($user_type,"Staff Admin") == 0 || strcmp($user_type,"Staff") == 0 )
										{
											$curr_url = '../controller/paymentscontroller.php';		
											$next_url = '../controller/paymentscontroller.php';
											$base_url = 'http://www.ace-success.com.sg/dashboard';
											/*
											echo '<td class="center">
												<a class="btn btn-success" href="'.$next_url.'?&id='.$row1['transaction_id'].'&action=Edit&transaction_company_name='.$row1['customer_company_name'].'">
													<i class="halflings-icon white edit"></i>  
													
												</a>';
											*/
											
											$next_url = $base_url.'/model/delete.php';
											$curr_url = $base_url.'/controller/paymentscontroller.php';
											if(strcmp($user_type,"Super Admin") == 0 || strcmp($user_type,"Staff Admin") == 0)
											{
												/*
												echo'	
												<a class="btn btn-danger" href="'.$next_url.'?previous_url='.$curr_url.'&tbname=transactions&id='.$row1['transaction_id'].'&fieldname=transaction_id">
													<i class="halflings-icon white trash"></i> 
												</a>';
												*/
											}
											echo '<td>';
											echo'
											<a class="btn btn-primary" href="paymentscontroller.php?action=Add_partial&transaction_id='.$row1['transaction_id'].'&invoice_num='.$row1['transaction_invoice_num'].'&amount='.$row1['transaction_contract_amount'].'&company_name='.$row1['customer_company_name'].'">Check Payment details
											</a>
											</td>';
											
										}
										else if(strcmp($user_type,"Customer") == 0 || strcmp($user_type,"Customer Admin") == 0)
										{
											echo'<td>
											<a class="btn btn-primary" href="paymentscontroller.php?action=Add_partial&transaction_id='.$row1['transaction_id'].'&invoice_num='.$row1['transaction_invoice_num'].'&amount='.$row1['transaction_contract_amount'].'&company_name='.$row1['customer_company_name'].'">Check Payments history
											</a>
											<a class="btn btn-primary btn-success" target="blank" href="../controller/paymentscontroller.php?action=Paypal&invoice_num='.$row1['transaction_invoice_num'].'&payment_amount='.$amt.'&company_name='.$row1['customer_company_name'].'"></i>Pay via Paypal</a>
											</td>';
										}
										echo'								
										</tr>';
									}
								}
							}
						echo'
							</tbody>
						</table>
					</div>
				</div>
			</div>';
	
	}
	
 
 

?>
</div>
</div>
</div>
</div>
<!-- End of container and row fluid-->
<?php

/* 
* Place Footer Content Here
*/
require_once('../templates/ams/views/footer.php');
?>