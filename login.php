<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
	if(isset($_POST['login']))
	{
		$email=$_POST['email'];
		$password=$_POST['password'];
		$admin = "admin@gmail.com";
		$admin_login = mysqli_query($con,"select * from login_details where email='$email' AND password='$password'");
		$admin_result = mysqli_fetch_array($admin_login);
		$student_login = mysqli_query($con,"select * from student_details where email='$email' AND password='$password'");
		$student_result = mysqli_fetch_array($student_login);
		if($admin_result>0){
			$_SESSION['detsuid']=$admin_result['id'];
			$_SESSION['userType']=1;
			header('location:admin-dashboard.php');
		}elseif ($student_result>0) {
			$_SESSION['detsuid']=$student_result['studentID'];
			$_SESSION['userType']=2;
			header('location:student-dashboard.php');
		}else{
			$msg="Invalid Details.";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Library Management System || Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
</head>
<body>

	<div class="row">
		<h2 align="center">Library Management System</h2>
		<hr />
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"><?php if($msg){echo $msg;}?></p>
						<form role="form" action="" method="post" id="">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" required="true">
							</div>
							
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" required="true">
								<a href="forgot-password.php">Forgot Password?</a>
							</div>
							
							<div class="checkbox">
								<button type="submit" value="login" name="login" class="btn btn-primary">login</button><span style="padding-left:250px">
								<!-- <a href="register.php" class="btn btn-primary">Register</a></span> -->
							</div>
							</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
</body>
</html>
