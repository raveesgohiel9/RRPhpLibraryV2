<?php

use model\user as user;
//echo "User testing here";
$userObj  = new user;
$result = $userObj->getRecords();

?>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Customers</h2><a style="margin: -5px 0 0px 10px;" class="btn btn-small btn-success" href="../controller/customerscontroller.php?action=Add"></i>Add Customer</a>
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
								  <th>ID</th>
                                                                  <th>First Name</th>
								  <th>Last Name</th>
								  <th>Email</th>
								  <th>Actions</th>		
							 </tr>
						  </thead>   
						  <tbody>
						  <?php
						  
						 
						  $rowcount = mysql_num_rows($result);
							if($rowcount > 0)
							{
								while ($row = mysql_fetch_assoc($result)) 
								{
									echo '<tr>';
									for($j=0; $j < count($fieldlist); $j++) 
									{
											if(strcmp($fieldlist[$j],'user_is_active')==0) 
											{
												if($row[$fieldlist[$j]] == 1) 
												{
													echo '<td class="center">
														<span class="label label-success">Active</span>
														</td>';
												}
												else 
												{
													echo '<td class="center">
														<span class="label">Inactive</span>
													</td>';
												}
											}
                                                                                        else if(strcmp($fieldlist[$j],'customer_fye')==0)
                                                                                        {
                                                                                            $fye_date = explode("/",$row[$fieldlist[$j]]);
                                                                                            echo "<td>".$fye_date[1]."-".$fye_date[0]."-".$fye_date[2]."</td>";
                                                                                        }
											else 
											{
												echo "<td>".$row[$fieldlist[$j]]."</td>";
											}
									}
									$curr_url = '../controller/userscontroller.php';		
									$next_url = '../controller/userscontroller.php';
									$base_url = 'http://www.mymvc.com.sg/dashboard';
									echo '<td class="center">
										<a caption="edit" class="btn btn-success" href="'.$next_url.'?&id='.$row['customer_id'].'&action=Edit">
											<i class="halflings-icon white edit"></i>  
											
										</a>';
									
									if($row['customer_is_active']==1)
									{	
										$next_url = $base_url.'/model/deactivate.php';
										$curr_url = $base_url.'/controller/userscontroller.php';
										echo'	
											<a class="btn btn-info" href="'.$next_url.'?previous_url='.$curr_url.'&tbname=users&id='.$row['user_id'].'&fieldname=user_id&active=user_is_active">
												<i class="halflings-icon white remove"></i>  
											</a>';
									}
									else
									{
										$next_url = $base_url.'/model/activate.php';
										$curr_url = $base_url.'/controller/userscontroller.php';
										echo'	
											<a class="btn btn-info" href="'.$next_url.'?previous_url='.$curr_url.'&tbname=users&id='.$row['user_id'].'&fieldname=user_id&active=user_is_active">
												<i class="halflings-icon white ok"></i>  
											</a>';	
									}
									
									$next_url = $base_url.'/model/delete.php';
									$curr_url = $base_url.'/controller/userscontroller.php';
									if(strcmp($user_type,"Super Admin") == 0 || strcmp($user_type,"Staff Admin") == 0)
									{
										echo'	
										<a class="btn btn-danger" href="'.$next_url.'?previous_url='.$curr_url.'&tbname=users&id='.$row['user_id'].'&fieldname=user_is_active">
											<i class="halflings-icon white trash"></i> 
										</a>';
									}
									echo'</td>								
									</tr>';
								}
							}
							
						  ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
