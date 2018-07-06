<?php
	session_start();
	include('../include/db.php');
	if(! (isset($_SESSION['UID']))){
		header("Location:index.php");
	}
    
?>
<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/form_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:13:40 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VMS</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" width="60" height="60" src="img/avatar.png" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['name'] ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $_SESSION['user_level'] ?> <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.php">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        VMS
                    </div>
                </li>
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a></li>
            
                <li>
                    <a href="visitors.php"><i class="fa fa-users"></i> <span class="nav-label">Visitors</span></a>
                </li>

                <li>
                    <a href="logout.php"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
                </li>
                
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Visitor Management System (VMS)</span>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>User Profile</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                                <form method="post" class="form-horizontal">
                                <?php
                                    if(isset($_POST['name'])){
                                        $name = trim($_POST['name']);
                                        $username = trim($_POST['username']);
                                        // $check = mysql_query("SELECT * FROM users WHERE username='$username' ",$con);
                                        // if(mysql_num_rows($check) > 0){
                                        //     echo '<p style="color: #D8000C;font-weight: bold;">That user already exists in the system.</p>';
                                        // }else{
                                            mysql_query("UPDATE users SET name='$name',username='$username',updated_at=NOW() WHERE id = ".$_SESSION['UID'],$con);
                                            if(mysql_error()==""){
                                                $_SESSION['name'] = $name;
                                                $_SESSION['username'] = $username;
                                                echo '<p style="color: #4F8A10;font-weight: bold;">Successfully updated profile</p>';
                                            }
                                            else{
                                                echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
                                            }
                                        }
                                ?>
                                    <div class="form-group"><label class="col-lg-2 control-label">Name</label><div class="col-lg-10"> <input type="text" name="name" placeholder="Enter Full Name" class="form-control" required value="<?php echo $_SESSION['name']?>"></div></div>
                                    <div class="form-group"><label class="col-lg-2 control-label">Username</label> <div class="col-lg-10"><input type="text" placeholder="Enter Username" required name="username" class="form-control" value="<?php echo $_SESSION['username']?>"></div></div>
                                    <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary" type="submit">Update Profile</button>
                                    </div>
                                    
                                </form>
                    </div>
                </div>
            </div>
    </div>

            <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Change Password</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                        <form method="post" class="form-horizontal">
                                <?php
                                    if(isset($_POST['currentpassword'])){
                                        $currentpassword = trim($_POST['currentpassword']);
                                        $newpassword = trim($_POST['newpassword']);
                                        $confirmpassword = trim($_POST['confirmpassword']);
                                        $check = mysql_query("SELECT * FROM users WHERE id = ".$_SESSION['UID']." AND password = '".md5($currentpassword)."'",$con);
                                        echo mysql_error();
                                        if(mysql_num_rows($check) == 0){
                                            echo '<p style="color: #D8000C;font-weight: bold;">That is not your current password.</p>';
                                        }else if($newpassword != $confirmpassword){
                                            echo '<p style="color: #D8000C;font-weight: bold;">New password doesn`t match confirm password field.</p>';
                                        }else{
                                            mysql_query("UPDATE users SET password='".md5($confirmpassword)."',updated_at=NOW() WHERE id = ".$_SESSION['UID'],$con);
                                            if(mysql_error()==""){
                                                $_SESSION['password'] = md5($confirmpassword);
                                                echo '<p style="color: #4F8A10;font-weight: bold;">Successfully updated password</p>';
                                            }
                                            else{
                                                echo mysql_error();
                                                echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
                                            }
                                        }
                                    }
                                ?>
                                <div class="form-group"><label class="col-lg-4 control-label">Current Password</label>

                                    <div class="col-lg-8"><input type="password" required placeholder="Current Password" name="currentpassword" class="form-control"> 
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-4 control-label">New Password</label>

                                    <div class="col-lg-8"><input type="password" required placeholder="New Password" name="newpassword" class="form-control"></div>
                                </div>

                                <div class="form-group"><label class="col-lg-4 control-label">Confirm Password</label>

                                <div class="col-lg-8"><input type="password" required placeholder="Confirm Password" name="confirmpassword" class="form-control"></div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary" type="submit">Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2015
            </div>
        </div>

        </div>
        </div>


    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/form_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:13:41 GMT -->
</html>
