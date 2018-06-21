<?php

	if(isset($_POST['cancelled']))
	{
		
		echo'
			<script type="text/javascript">
				alert("Password update cancelled. Window will close now");
				window.close();
			</script>';
	}

	if(isset($_POST['submitted']))
	{
		$new_password = $_POST['password'];
		$new_conPassword = $_POST['conPassword'];
		$user_code = $_POST['user_code'];
		
		require_once("../RRPhpLibrary/RRPhpLibrary.php");
		$pCrud = new PhpCrud();

		$tableList = new TableList();
		$tbname = "users";
		
		$con = $pCrud->connection($servername,$username,$password,$dbname);
		$where = " password='".md5($new_password)."' where user_code='".$user_code."'";
		$result = $pCrud->UpdateWhere($con,$tbname,$where);
		//$result = $pCrud->UpdateWherePrint($con,$tbname,$where);		
		if($result)
		{
			//$row = mysql_fetch_assoc($result);
			$to = $user_email;
			$Subject = "Password reset";
			$message = "Kindly take a not of your new password - ".$randomstring;
						
			mail($to,$Subject,$message);
			
			$pCrud->disconnection($con);
			
			
			echo'
			<script type="text/javascript">
				alert("Password updated. Window will close now");
				window.close();
			</script>
		    ';
			
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
				body { background: url(../templates/ams/img/bg-login.jpg) !important; }
			</style>
	</head>

	<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					
					<h2>Forgot password</h2>
					<form class="form-horizontal" action="changePassword.php" method="post" onsubmit="return validate_form(this);">
						<fieldset>
							
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input required class="input-large span10" name="password" id="password" type="password" placeholder="New Password"/>
								
							</div>
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input required class="input-large span10" name="conPassword" id="conPassword" type="password" placeholder="Enter password Again" onkeyup=""/>
							</div>
							<div class="clearfix"></div>
							<input type="hidden" name="user_code" value="<?php echo $_REQUEST['user_code']; ?>">
							
							
							
						

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
<script type="text/javascript">
	function validate_form(theForm){
		
		
		
		if (theForm.password.value != theForm.conPassword.value)
		{
			alert("The passwords don\'t match!");
			document.getElementById("password").style.backgroundColor = "#e52213";
			//theForm.conPassword.setCustomValidity('Password do not match');
			return false;
			
		} 
		else 
		{
			return true;
		}
	}
	
	
</script>