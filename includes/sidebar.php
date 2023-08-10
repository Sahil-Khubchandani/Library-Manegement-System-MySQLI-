<?php
    session_start();
    error_reporting(0);
    include('includes/dbconnection.php');
?>


<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <?php
                $uid=$_SESSION['detsuid'];
                if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
                    $admin_login = mysqli_query($con,"select fullName from login_details where id='$uid'");
                    $admin_result = mysqli_fetch_array($admin_login);
                    $name=$admin_result['fullName'];
                }else{
                    $student_login = mysqli_query($con,"select fullName from student_details where id='$uid'");
                    $student_result = mysqli_fetch_array($student_login);
                    $name=$student_result['fullName'];
                }
            ?>
            <div class="profile-usertitle-name"><?php echo $name; ?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>    
    <ul class="nav menu">
        <?php
            if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
        ?>
        <li class="active"><a href="admin-dashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
        <?php } else{ ?>
            <li class="active"><a href="student-dashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
        <?php }?>
        
        <li class="parent ">
            <a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em>Books <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <?php
                    if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
                ?>
                <!-- Admin Dashboard -->
                <li><a class="" href="add-books.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Add Book Details
                </a></li>
                <li><a class="" href="manage-books.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Manage Books
                </a></li>
                <li><a class="" href="issued-book-details.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Issued Books
                </a></li>
                <li><a class="" href="book-issue-request.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Book Issue Request
                </a></li>
                <!-- Admin Dashboard -->
                <?php } else{ ?>
                
                <!-- Student Dashboard -->
                <li><a class="" href="manage-books.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Available Books
                </a></li>
                <li><a class="" href="issue-book.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Issue Book
                </a></li>
                <li><a class="" href="issued-book-details.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Books Issued
                </a></li>
                <!-- Student Dashboard -->
                <?php }?>
            </ul>
        </li>

        <?php
            if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
        ?>
        <li class="parent ">
            <a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-navicon">&nbsp;</em>Student Details<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li><a class="" href="add-student-details.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Add Students
                </a></li>
                <li><a class="" href="student-details.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Students List
                </a></li>
            </ul>
        </li>
        <?php }?>
        <li>
            <a href="user-profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a>
        </li>
        <li>
            <a href="change-password.php"><em class="fa fa-clone">&nbsp;</em> Change Password</a>
        </li>
        <li>
            <a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a>
        
        </li>
    </ul>
</div>