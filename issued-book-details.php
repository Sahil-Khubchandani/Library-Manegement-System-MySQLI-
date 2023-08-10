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
	<title>Library Management System || Issued Book Details</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!-- Custom Font -->
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
				<li class="active">Issued Book Details</li>
			</ol>
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12">		
				<div class="panel panel-default">
					<div class="panel-heading">Issued Book Details</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered mg-b-0">
									<thead>
										<tr>
											<th>S.NO</th>
											<th>Student Id</th>
											<?php 
												if (isset($_SESSION['userType']) && $_SESSION['userType'] == 1) {
													echo"<th>Student Name</th>";
													echo"<th>Email</th>";
												}
											?>
											<th>Book Name</th>
											<th>Status</th>
											<th>Issued Date</th>
											<th>Return Date</th>
											<th>Penalty</th>
											<th>Returned Date</th>
										</tr>
									</thead>
									<?php
										$userid=$_SESSION['detsuid'];
										if (isset($_SESSION['userType']) && $_SESSION['userType'] == 1) {
											$ret=mysqli_query($con,"select * from`book_issue_request`");
										}else{
											$ret=mysqli_query($con,"select * from`book_issue_request` where studentID='$userid'");
										}
										$cnt=1;
										$penalty = 0;
										while ($row=mysqli_fetch_array($ret)) {
											
									?>
									<tbody>
										<tr>
											<td><?php echo $cnt;?></td>
											<td><?php echo $row['studentID'];?></td>
											<?php 
												if (isset($_SESSION['userType']) && $_SESSION['userType'] == 1) {
													echo"<td>".$row['fullName']."</td>";
													echo"<td>".$row['email']."</td>";
												}
											?>
											<td><?php echo $row['bookName'];?></td>
											<?php 
												if($row['status'] == 1){
													echo "<td><em>Approved</em></td>";
												}elseif($row['status'] == 2) {
													echo "<td><em>Book is not available<em></td>";
												}elseif($row['status'] == 0){
													echo"<td><em>Pending<em></td>";
												}elseif($row['status'] == 3){
													echo"<td><em>Book Returned<em></td>";
												}else{}
											?>
											<td><?php echo $row['issueDate'];?></td>
											<td><?php echo $row['returnDate'];?></td>
											<td><?php echo $row['penalty'];?></td>
											<td><?php echo $row['returnedDate'];?></td>
											<?php 
												if (isset($_SESSION['userType']) && $_SESSION['userType'] == 2) {
													if ($row['status']==1) {
														
														?>
											<form method="post" onsubmit="return myFunction()">
												<td>
													<button type="submit" name="returnBTN" value="<?= $row['id'] ?>" class="btn btn-primary" >Return</button>
													<input type="hidden" id="return" name="return"></input>
												</td>
											</form>
											<?php
													}
												}
											?>
										</tr>
										<?php 
												$cnt=$cnt+1;
											}
											if (isset($_POST['returnBTN'])) {
												// echo"<script>alert('Entered if.');</script>";
												$q1 = mysqli_query($con,"select * from book_issue_request where id='".$_POST['returnBTN']."'");
												$q1Result = mysqli_fetch_array($q1);
												$currentDate = date("Y-m-d");
												$timestamp = strtotime($currentDate); //present day date in seconds
												$timestamp1 = $q1Result['returnDate']; //return day date
												$timestamp2 = strtotime($timestamp1); //return day date in seconds
												$diff = $timestamp - $timestamp2; // difference between present day date and return day date(in seconds)
												$days = $diff/86400; //converting difference in days
												$penalty = $days*100;
												if ($penalty>0) {
													$query = mysqli_query($con,"update book_issue_request set returnedDate='$currentDate', status=3, penalty='$penalty' WHERE studentID='$userid' AND id='".$_POST['returnBTN']."'");
												}else {
													$query = mysqli_query($con,"update book_issue_request set returnedDate='$currentDate', status=3 WHERE studentID='$userid' AND id='".$_POST['returnBTN']."'");
												}
												$query1 = mysqli_query($con,"select * from books where bookName='".$q1Result['bookName']."'");
												$result = mysqli_fetch_array($query1);
												$stock = $result['stock'];
												$updatedStock = $stock + 1;
												$query2 = mysqli_query($con,"update books set stock='$updatedStock' where bookID='".$result['bookID']."'");
												echo "<script>window.location.href='issued-book-details.php';</script>";
												if($query){
													echo "<script>alert('Book has been returned.');</script>";
												}else{
													echo "<script>alert('Something went wrong.');</script>";
												}
												// $query1 = mysqli_query($con,"update book_issue_request set status=3 where id='".$_POST['returnBTN']."'");
											}
										?>
										<script>
											function myFunction(){
												var val = confirm("Do you want to return the book?");
												if(val == true){
													document.getElementById("return").innerHTML="confirm";
													document.getElementsByName("returnBTN").style.display="none";
								
												}else{
													document.getElementById("return").innerHTML="declined";
												}
												return val;
											}
										</script>
									</tbody>
								</table>
							</div>				
						</div>
					</div>
				</div><!-- /.panel -->
			</div><!-- /.col -->
		<?php //include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!-- /.main -->
	
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