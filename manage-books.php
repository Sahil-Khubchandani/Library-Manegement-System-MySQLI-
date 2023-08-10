<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
	if (strlen($_SESSION['detsuid']==0)) {
		header('location:logout.php');
	} else{
		//code deletion
		if(isset($_GET['delid'])){
			$rowid=intval($_GET['delid']);
			$query=mysqli_query($con,"delete from books where bookID='$rowid'");
			if($query){
				echo "<script>alert('Record successfully deleted');</script>";
				echo "<script>window.location.href='manage-books.php'</script>";
			} else {
				echo "<script>alert('Something went wrong. Please try again');</script>";
			}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Library Management System || Manage books</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

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
				<li class="active">
					<?php 
						if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
							echo "Manage books";
						}else{
							echo "Available books";
						}
					?>	
				</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					<?php 
						if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
							echo "Manage books";
						}else{
							echo "Available books";
						}
					?>	
					</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){echo $msg;}  ?> </p>
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered mg-b-0">
									<thead>
										<tr>
											<th>SR.NO</th>
											<th>Book Id</th>
											<th>Book Name</th>
											<?php
												if (isset($_SESSION['userType']) && $_SESSION['userType']==1) {
													echo "<th>Stock</th>";
													echo "<th>Action</th>";
												}
											?>
										</tr>
									</thead>
									<?php
										$userid=$_SESSION['detsuid'];
										$ret=mysqli_query($con,"select * from books");
										$cnt=1;
										while ($row=mysqli_fetch_array($ret)) {
									?>
									<tbody>
										<tr>
											<td><?php echo $cnt;?></td>
											<td><?php  echo $row['bookID'];?></td>
											<td><?php  echo $row['bookName'];?></td>
											<?php
												if (isset($_SESSION['userType']) && $_SESSION['userType']==1) { ?>
													<td><?php  echo $row['stock'];?></td>
													<td>
													<button class='btn btn-warning' onclick="$('#bookID').val(<?= $row['bookID']; ?>); $('#stock').val(<?= $row['stock'] ?>);" data-toggle='modal' data-target='#editButton'><a  style='color: #fff;'>Edit</a></button>
													<button class='btn btn-danger'><a href='manage-books.php?delid=<?= $row['bookID']; ?>' style='color: #fff;'>Delete</a></button>
													</td>
												<?php } ?>
											<?php $cnt=$cnt+1;} ?>
											<div class="modal fade" id="editButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">New message</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form method="post">
																<input type="hidden" name="bookID" id="bookID">
																<div class="form-group">
																	<label for="recipient-name" class="col-form-label">Enter Stock details</label>
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" id="stock" name="stockDetails"></input>
																</div>
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary" name="update">Update</button>
															</form>
														</div>
													</div>
												</div>
											</div>
											<?php
												if(isset($_POST['update'])){
													$stockDetails = $_POST['stockDetails'];
													$query = mysqli_query($con,"update books set stock='$stockDetails' where bookID='".$_POST['bookID']."'");
													if ($query) {
														echo "<script>window.location.href='manage-books.php';</script>";
													}else{
														echo "<script>alert('failed to updated');</script>";
													}
												}else{}						
											?>

											<script>
												$('#editButton').on('show.bs.modal', function (event) {
													var button = $(event.relatedTarget) // Button that triggered the modal
													var recipient = button.data('whatever') // Extract info from data-* attributes
													// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
													// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
													var modal = $(this)
													modal.find('.modal-title').text('New message to ' + recipient)
													modal.find('.modal-body input').val(recipient)
												})
											</script>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
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
<?php }  ?>