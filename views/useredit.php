<?php

use model\user as user;
$user = new user;
if(isset($_POST['cancelled']))
{	
    header("Location: customerscontroller.php");
}
if(isset($_POST['userSubmitted']))
{		
	
    $userID = $_REQUEST['userID'];
    $userLname = $_REQUEST['userLname'];
    $userFname = $_REQUEST['userFname'];
    $userEmail = $_REQUEST['userEmail'];
	
    /*
    * Getting the list of columns of a table using the TableList class to save time on mysql statement
    */
    $values = array($customer_client_code,$customer_company_name,$customer_contract_num,$customer_uen,$customer_contract_start_date,$customer_contract_end_date,$customer_company_type,$customer_industry,$customer_fye,$customer_discount,$customer_gst_registered,$customer_fax,$customer_contact_person1,$customer_mobile1,$customer_office_phone,$customer_email1,$customer_gender1,$customer_designation1,$customer_contact_person2,$customer_mobile2,$customer_email2,$customer_gender2,$customer_designation2,$customer_contact_person3,$customer_mobile3,$customer_email3,$customer_gender3,$customer_designation3,$customer_contact_person4,$customer_mobile4,$customer_email4,$customer_gender4,$customer_designation4,$customer_contact_person5,$customer_mobile5,$customer_email5,$customer_gender5,$customer_designation5,$customer_address1,$customer_address2,$customer_address3,$customer_notes,$customer_is_active);

    $where = " where user_id=".$userID;
    $result = $user->updateRecord($values,$where);
    if($result==1)	
    {
        header("Location: userscontroller.php");
    }
	
}

?>
<div class="row-fluid sortable" onload = "HideOnLoad()">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Customers</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						
						<?php
                                                    $id = $_REQUEST['userID'];
                                                    $result = $user->getRecord($id);
                                                    $rowcount = mysql_num_rows($result);
                                                    if($rowcount>0)
                                                    {
                                                            $row = mysqli_fetch_assoc($result);

							?>
				<form class="form-horizontal" action="userscontroller.php?action=Edit&id=<?php echo $id;?>" method="post" onsubmit="return validate_form(this);">
									
					<fieldset>
					<table border="0" width="70%"cellspacing="10">	
						<tr>
							<td width="30%">
								<div class="control-group">
								  <label class="control-label" for="focusedInput"> First Name</label>
								  <div class="controls">
									<input required name="userLname" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $row['userLname'] ; ?>" >
									<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div>
						</div>
							</td>
							<td  width="30%">
								<div class="control-group">
								  <label class="control-label" for="focusedInput">Last Name</label>
								  <div class="controls">
									<input required name="userFname" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $row['userFname'] ; ?>">
									<!--<p class="help-block">Start typing to activate auto complete!</p>-->
    							  </div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="control-group">
								  <label class="control-label" for="focusedInput">Email</label>
								  <div class="controls">
									<input required name="userEmail" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $row['userEmail'] ; ?>">
									<!--<p class="help-block">Start typing to activate auto complete!</p>-->
									</div>
								</div>
							</td>
							
						</tr>
						
					</table>
							<div class="form-actions">
								 <button name = "userSubmitted" type="submit" class="btn btn-primary" >Save changes</button>
									<button formnovalidate name="cancelled" class="btn">Cancel</button>
							</div>
					</fieldset>
									
				</form>
								  <?php
								//}
							}
						?>           
					</div>
				
				</div><!--/span-->
				
			</div><!--/row-->
						

