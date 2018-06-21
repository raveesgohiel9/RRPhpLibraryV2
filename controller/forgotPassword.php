<?php

	if(isset($_POST['cancelled']))
	{
            echo'
                <script type="text/javascript">
                        alert("Password reset cancelled. Window will close now");
                        window.close();
                </script>';
		//header("Location: login.php");
	}

	if(isset($_POST['submitted']))
	{
		$user_id = $_POST['user_id'];
		//echo "User id-".$user_id;
		
		require_once("../RRPhpLibrary/RRPhpLibrary.php");
		$pCrud = new PhpCrud();

		$tableList = new TableList();
		$tbname = "users";
		
		$characters = "dkgfdgfd_)#5h_gf6575688#6ytty6gtg549gujrigjyjerot4(_tvfg()5656576_6y65u6yt549g#jg_3243r4t5460948fjeofjr2322sdfdfgtret7786tgjkolgxxawwe";
		$min = 0;
		$max = strlen($characters) - 10;
		$randomNumber = rand($min,$max);
		$randomstring = substr($characters,$randomNumber,10);
				
		$con = $pCrud->connection($servername,$username,$password,$dbname);
		$where = " password='".md5($randomstring)."' where user_nric='".$user_id."' AND user_is_active='1'";
		$result = $pCrud->UpdateWhere($con,$tbname,$where);
		//$result = $pCrud->UpdateWherePrint($con,$tbname,$where);
                
                //echo "User id again-".$user_id;
                //print_r($result);
                //$rowCount = mysqli_affected_rows($result);
                //echo "Row count:".$rowCount;
		
                if($result)
		{
                        //echo "User id reloaded-".$user_id;
                        $where1 = " where user_nric='".$user_id."' AND user_is_active='1'";
                        $result1 = $pCrud->SimpleSelectWhere($con, $tbname, $where1);
                        //$result1 = $pCrud->SimpleSelectWherePrint($con, $tbname, $where1);
                    
			$row1 = mysql_fetch_assoc($result1);
                        //print_r($row1);
			$to = $row1['user_email_id'];
			$Subject = "Password reset";
                        $message = '<html><body>';
                        $message .= '<p align="left">Dear '.$row1['user_fname'].',</p><br>';
                        $message .= '<p align="left">Here is your login username and password.</p><br>';
                        $message .= '<table width="25%">';
                        $message .= '<tr>';
                        $message .= '<td>User ID:<br>Password:</td>';
                        $message .= '<td bgcolor="fbdae8">'.$user_id.'<br>'.$randomstring.'</td>';
                        $message .= '</tr>';
                        $message .= '</table>';
			$message .= '<p align="left">If you wish to change your password at any time, please login using the USER ID and password, then select the "Account" option from the top menu bar, click Edit Account to change your personal details. Logon directly here! http:/www.ace-success.com.sg</p><br>';
                        $message .= '<p align="left">Sincerely Yours</p><br>';
                        $message .= '<p align="left">Ace Success Pte Ltd</p><br>';
                        $message .= '<p align="left">Customer Care: (65) 65139221</p><br>';
                        $message .= '</html></body>';
                        
                        
			$headers = "From: admin@ace-success.com.sg\r\n";
			$headers .= "Reply-To: admin@ace-success.com.sg\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";			
			mail($to,$Subject,$message,$headers);
			
			$pCrud->disconnection($con);
			echo 
			'<script type="text/javascript">
			 alert("Password Reset. Kindly check your email for your new password. Window will close now!"); 
                         window.close();';
			echo'</script>';
                     
		}
		else
		{
			echo 
			'<script type="text/javascript">
			 alert("Login id not registered or deactivated. Window will close now!");
                        window.close();
			</script>';
                }
		
		
	}

?>
<html>
	<head>
		<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
		<link href="../templates/ams/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link id="base-style" href="../templates/ams/css/style.css" rel="stylesheet">
		<link id="base-style-responsive" href="../templates/ams/css/style-responsive.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
		<style type="text/css">
				body {background-color:#edfefa;}
			</style>
	</head>

	<body>
            <p align="center"><img src="../templates/ams/img/logo.png" width="150" height="120"></p>     
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					
					<h2>Forgot password</h2>
					<form class="form-horizontal" action="forgotPassword.php" method="post">
						<fieldset>
							
							<div class="input-prepend" title="User NRIC">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input required class="input-large span10" name="user_id" id="user_email" type="text" placeholder="Enter User ID/User NRIC"/>
							</div>
							<div class="clearfix"></div>

							
							
							
						

							<div class="button-login">	
								<button name="submitted" type="submit" class="btn btn-primary">Submit</button>
								<button formnovalidate name="cancelled" class="btn btn-primary">Cancel</button>
							</div>
							
					</form>
					<hr>
					<!--<h3>Forgot Password?</h3>-->
					
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->

	</body>
</html>