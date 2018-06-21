<?php

    $module="Customers";
    if(!isset($user_code))
    {
        //--header("Location: login.php");
    }

/*
 * Calling the topbar from template
*/
if(!isset($_POST['customerSubmitted']))
{
	//--require_once("../templates/ams/views/header.php");
	//--require_once("../templates/ams/views/topbar.php");
}
?>
<body onload="hide_buttons();">
<!-- Start of container and row fluid -->
<div class="container-fluid-full">
	<div class="row-fluid">
	<?php
	/*
	 * Place the sidebar menu here
	 */
//--require_once("../templates/ams/views/menu.php");
?>
<!-- start: Content -->
<div id="content" class="span10" >
	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.php">Home</a> 
			<i class="icon-angle-right"></i>
		</li>
	<li><a href="customerscontroller.php">Customers</a></li>
</ul>

<?php
/*
 * 3 Types of actions in the user
 * 1.View
 * 2.Edit
 * 3.Add
 */
 
 if(isset($_REQUEST['action']))
 {
	 $action = $_REQUEST['action'];
 }
 else
 {
	 $action = 'View';
 }


 if(strcmp($action,'View')==0)
 {
	require_once("../views/customersview.php");
 }
 else if(strcmp($action,'Edit')==0)
 {
	 $id = $_REQUEST['id'];
	 
	 require_once("../views/customersedit.php");
 }
 else if(strcmp($action,'Add')==0)
 {
	 require_once("../views/customersadd.php");
 }

?>
</div>
</div>
</div>
<!-- End of container and row fluid-->
<?php

/* 
* Place Footer Content Here
*/
require_once("../templates/ams/views/footer.php");
?>