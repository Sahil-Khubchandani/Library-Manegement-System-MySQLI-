<?php  
session_start();
error_reporting(1);
include('includes/dbconnection.php');
	
	date_default_timezone_set("Asia/Kolkata");
	$userID=$_SESSION['detsuid'];
	$issueDate = date('Y-m-d');
	$returnDate = date('Y-m-d',strtotime($issueDate.'+30 days'));
	if (strlen($_SESSION['detsuid']==0)) {
		header('location:logout.php');
	}
	if(isset($_POST['approve'])){
		$query = mysqli_query($con,"update book_issue_request set status=1,  issueDate = '$issueDate', returnDate='$returnDate' where id=".$_POST['approve']."");
		$query1 = mysqli_query($con,"select * from book_issue_request where id='".$_POST['approve']."'");
		$ret = mysqli_fetch_array($query1);
		$query2 = mysqli_query($con,"select * from books where bookName='".$ret['bookName']."'");
		$row = mysqli_fetch_array($query2);
		$stock = $row['stock'];
		$updatedStock = $stock - 1;
		$query1 = mysqli_query($con,"update books set stock='$updatedStock' where bookName='".$row['bookName']."'");
		echo "<script>alert('Request responded successfully');</script>";
	}elseif(isset($_POST['reject'])){
		$query = mysqli_query($con,"update book_issue_request set status=2 where id=".$_POST['reject']."");
		echo "<script>alert('Request responded successfully');</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Library Management System || Book Issue Request</title>
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
				<li>
					<a href="#"><em class="fa fa-home"></em></a>
				</li>
				<li class="active">Book Issue Request</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Book Issue Request</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered mg-b-0">
									<thead>
										<tr>
											<th>S.NO</th>
											<th>Student Id</th>
											<th>Student Name</th>
											<th>Email Id</th>
											<th>Book Name</th>
											<?php
												if(isset($_SESSION['userType']) && $_SESSION['userType']==1){
													echo"<th>Action</th>";
												}
											?>
										</tr>
									</thead>
									<?php
										$userid=$_SESSION['detsuid'];
										$ret=mysqli_query($con,"select * from`book_issue_request` where status=0");
										$cnt=1;
										while ($row=mysqli_fetch_array($ret)) {
									?>
									<tbody>
										<tr>
											<td><?php echo $cnt;?></td>
											<td><?php echo $row['studentID'];?></td>
											<td><?php echo $row['fullName'];?></td>
											<td><?php echo $row['email'];?></td>
											<td><?php echo $row['bookName'];?></td>
											<td>
												<?php
													if (isset($_SESSION['userType']) && $_SESSION['userType']==1){
														echo "<form method='post'>
														<button type='submit' class='btn btn-success' value='".$row['id'].";' name='approve'>Approve</button>
														<button type='submit' class='btn btn-danger' value='".$row['id'].";' name='reject'>Reject</button>
														</form>";
													}
												?>
											</td>
										</tr>
										<?php 
										$cnt=$cnt+1;
										}?>
									</tbody>
								</table>
							</div>
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
<?php // }  ?>