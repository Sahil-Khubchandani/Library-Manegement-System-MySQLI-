<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

  

  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Library Management System || Add Student Details</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Add Student Details</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Student Details</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							<form role="form" method="post" action="" name="bwdatesreport">
								<div class="form-group">
									<label>Id</label>
									<input class="form-control" type="text"  id="studentID" name="studentID" required="true">
								</div>
								<div class="form-group">
									<label>Name</label>
									<input class="form-control" type="text"  id="fullName" name="fullName" required="true">
								</div>
								<div class="form-group">
									<label>Phone Number</label>
									<input class="form-control" type="tel"  id="mobileNumber" name="mobileNumber" required="true">
								</div>
								<div class="form-group">
									<label>Email ID</label>
									<input class="form-control" type="email"  id="emailID" name="email" required="true">
								</div>
								<div class="form-group">
									<label>Address</label>
									<input class="form-control" type="text"  id="address" name="address" required="true">
								</div>
								
							
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Submit</button>
								</div>
								
								
								</div>
								
							</form>
							<?php

							if(isset($_POST['submit']))
							{
								$userid=$_SESSION['detsuid'];
								$studentID = $_POST['studentID'];
								$fullName = $_POST['fullName'];
								$mobileNumber = $_POST['mobileNumber'];
								$email = $_POST['email'];
								$address = $_POST['address'];
								$RESULT=mysqli_query($con,"insert into student_details(studentID, fullName, mobileNumber, password, email, address) values ('$studentID', '$fullName', '$mobileNumber', '$mobileNumber','$email', '$address')");
								if($RESULT){
									echo "<script>alert('Student Details has been added');</script>";
									echo "<script>window.location.href='student-details.php'</script>";
								}else {
										echo "<script>alert('Something went wrong. Please try again');</script>";
								}
							}
								
							?>
						</div>
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
<?php } ?>