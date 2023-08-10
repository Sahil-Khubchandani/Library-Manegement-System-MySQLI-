<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);
	if (strlen($_SESSION['detsuid']==0)) {
		header('location:logout.php');
	} else{
		if(isset($_POST['submit']) && !empty('submit')){
			$userid=$_SESSION['detsuid'];
			$cpassword=$_POST['currentpassword'];
			$newpassword=$_POST['newpassword'];
			if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
				$query=mysqli_query($con,"select * from login_details where id='$userid' and password='$cpassword'");
				$user = mysqli_fetch_array($query);
			}else{
				$query=mysqli_query($con,"select * from student_details where id='$userid' and password='$cpassword'");
				$user = mysqli_fetch_array($query);
			}
			print_r($user);
			if($user['password']!=$cpassword){
				echo "<script>alert('Your current password is not correct!');</script>";
			}else{
				if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
					$ret=mysqli_query($con,"update login_details set password='$newpassword' where id='$userid'");
				}else{
					$ret=mysqli_query($con,"update student_details set password='$newpassword' where id='$userid'");
				}
				if($ret){
					echo "<script> alert('Your password successully changed');</script>";
					if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
						echo "<script>window.location.href='admin-dashboard.php'</script>";
					}else{
						echo "<script>window.location.href='student-dashboard.php'</script>";
					}
				} else {
					$msg="Something Went wrong!";
					echo "<script> alert('Something Went wrong!');</script>";
				}
			}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Library Management System || Change Password</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<script type="text/javascript">
		function checkpass(){
			if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value){
				alert('New Password and Confirm Password field does not match');
				document.changepassword.confirmpassword.focus();
				return false;
			}
			return true;
		}
	</script>
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li>
					<a href="#"><em class="fa fa-home"></em></a>
				</li>
				<li class="active">Change Password</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Change Password</div>
						<div class="panel-body">
							<p style="font-size:16px; color:red" align="center"> <?php if($msg){echo $msg;}?></p>
							<div class="col-md-12">
								<form role="form" method="post" action="" name="changepassword" onsubmit="return checkpass();">
									<div class="form-group">
										<label>Current Password</label>
										<input type="password" name="currentpassword" class=" form-control" required= "true" value="">
									</div>
									
									<div class="form-group">
										<label>New Password</label>
										<input type="password" name="newpassword" class="form-control" value="" required="true">
									</div>
									
									<div class="form-group">
										<label>Confirm Password</label>
										<input type="password" name="confirmpassword" class="form-control" value="" required="true">
									</div>

									<div class="form-group has-success">
										<button type="submit" class="btn btn-primary" name="submit">Change</button>
									</div>
								</form>
							</div>
							<?php } ?>
						</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
		</div><!-- /.row -->
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>

</body>
</html>