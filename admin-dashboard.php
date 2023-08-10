<?php
	session_start();
	error_reporting(0);
	include('includes/dbconnection.php');
	if (strlen($_SESSION['detsuid']==0)) {
  		header('location:logout.php');
  	}else{
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Library Management System || Dashboard</title>
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
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<a href="manage-books.php">
				<div class="col-xs-6 col-md-3">		
					<div class="panel panel-default">
						<div class="panel-body easypiechart-panel">
							<?php
								$userid=$_SESSION['detsuid'];
								$query=mysqli_query($con,"select count(bookID)  as bookStock from books");
								$result=mysqli_fetch_array($query);
								$bookStock=$result['bookStock'];
							 ?> 
							<h4>Books Available</h4>
							<div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $bookStock;?>" >
								<span class="percent">
									<?php 
										if($bookStock==""){
											echo "0";
										}else {
											echo $bookStock;
										}
									?>
								</span>
							</div>
						</div>
					</div>
				</div>
			</a>
			<a href="issued-book-details.php">
				<div class="col-xs-6 col-md-3">
					<div class="panel panel-default">
						<?php
							$query3=mysqli_query($con,"select count(status) as issuedBooks from book_issue_request where status=1");
							$result3=mysqli_fetch_array($query3);
							$issuedBooks=$result3['issuedBooks'];
						 ?>
						<div class="panel-body easypiechart-panel">
							<h4>Total Books Issued</h4>
							<div class="easypiechart" id="easypiechart-red" data-percent="
							<?php 
								echo $totalStudents;
							?>" >
								<span class="percent">
									<?php 
										if($issuedBooks==""){
											echo "0";
										} else {
											echo $issuedBooks;
										}
									?>
								</span>
							</div>
						</div>
					</div>
				</div>
			</a>
			<a href="book-issue-request.php">
				<div class="col-xs-6 col-md-3">
					<div class="panel panel-default">
						<?php
							$query3=mysqli_query($con,"select count(status) as issuedBooks from book_issue_request where status=0");
							$result3=mysqli_fetch_array($query3);
							$issuedBooks=$result3['issuedBooks'];
						 ?>
						<div class="panel-body easypiechart-panel">
							<h4>Book Issue Request</h4>
							<div class="easypiechart" id="easypiechart-blue" data-percent="
							<?php 
								echo $totalStudents;
							?>" >
								<span class="percent">
									<?php 
										if($issuedBooks==""){
											echo "0";
										} else {
											echo $issuedBooks;
										}
									?>
								</span>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div><!--/.row-->

		<br><br>

		<div class="row">
		<a href="issued-book-details.php">
				<div class="col-xs-6 col-md-3">		
					<div class="panel panel-default">
						<div class="panel-body easypiechart-panel">
							<?php
								$userID=$_SESSION['detsuid'];
								$query=mysqli_query($con,"select sum(penalty) as penalty from book_issue_request");
								$result=mysqli_fetch_array($query);
								$penalty=$result['penalty'];
							?> 
							<h4>Total Penalty</h4>
							<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $penalty;?>" >
								<span class="percent">
									<?php 
										if($penalty==""){
											echo "0";
										}else {
											echo $penalty;
										}
									?>
								</span>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div><!--/.row-->

	</div>	<!--/.main-->
	<?php 
		include_once('includes/footer.php');
	?>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
			var chart1 = document.getElementById("line-chart").getContext("2d");
			window.myLine = new Chart(chart1).Line(lineChartData, {
				responsive: true,
				scaleLineColor: "rgba(0,0,0,.2)",
				scaleGridLineColor: "rgba(0,0,0,.05)",
				scaleFontColor: "#c5c7cc"
			});
		};
	</script>
</body>
</html>
<?php } ?>