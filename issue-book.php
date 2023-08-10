<?php
session_start();
error_reporting(1);
include('includes/dbconnection.php');
    $userID=$_SESSION['detsuid'];
    $query=mysqli_query($con,"select * from student_details where id = '$userID' ");
    $result=mysqli_fetch_array($query);
    if (isset($_POST['login'])) {
        $studentID = $_POST['studentID'];
        $studentName = $_POST['studentName'];
        $emailID = $_POST['emailID'];
        $books = $_POST['books'];
        $query = mysqli_query($con,"INSERT INTO `book_issue_request`(`studentID`, `fullName`, `email`, `bookName`) VALUES ('$studentID','$studentName','$emailID','$books');");
        if ($query) {
            echo "<script> alert('Request added successfully!');</script>";
            echo "<script>window.location.href='issued-book-details.php';</script>";
        }else{
            echo "<script> alert('Something went wrong!');</script>";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Library Management System || Issue Books</title>
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
					<a href=""><em class="fa fa-home"></em></a>
				</li>
				<li class="active">Issue Book</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Issue Book</h1>
			</div>
			<hr />
		</div><!--/.row-->
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">Request a book</div>
                    <div class="panel-body">
                        <form role="form" action="" method="post" id="" name="login">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Student ID" value="<?php echo $result['studentID'];?>" id="studentID" name="studentID" type="text" autofocus="" readonly>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Student Name" value="<?php echo $result['fullName'];?>" id="studentName" name="studentName" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Student Email ID" value="<?php echo $result['email'];?>" id="emailID" name="emailID" type="email" readonly>
                                </div>
                                <div class="form-group">
                                        <select class="form-control" name="books" id="books">
                                            <option value="" hidden selected disabled>Select book to be issued</option>
                                    <?php
                                        $ret=mysqli_query($con,"select bookName from books");
                                        while ($row=mysqli_fetch_array($ret)) { 
                                            echo '<option value="' . $row['bookName'] . '">' . $row['bookName'] . '</option>';
                                        } ?>
                                        </select>
                                </div>
                                <div class="checkbox">
                                    <button type="submit" id="submit" value="login" name="login" class="btn btn-primary">Submit</button><span style="padding-left:250px">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div><!-- .panel -->
            </div><!-- /.col -->
		</div><!-- /.row -->
	</div>	

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