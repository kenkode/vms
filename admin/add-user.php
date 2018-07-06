<?php
	session_start();
	include('../include/db.php');
	if(! (isset($_SESSION['UID']))){
		header("Location:index.php");
	}
	$row = mysql_fetch_array(mysql_query("SELECT count(*) FROM visitors"));
    $visitorsCount = $row[0];
    $row1 = mysql_fetch_array(mysql_query("SELECT count(*) FROM users"));
    $usersCount = $row1[0];
    if(isset($_POST['name'])){
        $name = trim($_POST['name']);
        $username = trim($_POST['username']);
        $user_level = trim($_POST['user_level']);
        $password = md5('123456');
        $check = mysql_query("SELECT * FROM users WHERE username='$username' ",$con);
        if(mysql_num_rows($check) > 0){
            echo '<p style="color: #D8000C;font-weight: bold;">That user already exists in the system.</p>';
        }else{
            mysql_query("INSERT INTO users(name,username,user_level,password,created_at,updated_at) VALUES('$name','$username','$user_level','$password',NOW(),NOW()) ",$con);
            if(mysql_error()==""){
                header("Location:users.php");
            }
            else{
                echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
            }
        }
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

                <li class="active">
                    <a href="users.php"><i class="fa fa-user"></i> <span class="nav-label">Users</span></a>
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
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>All form elements <small>With custom checbox and radion elements.</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal">
                            
                                <div class="form-group"><label class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" name="name" required></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Username</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" name="username" required></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">User Role</label>

                                    <div class="col-sm-10">
                                    <select class="form-control m-b" name="user_level" required>
                                        <option value=""></option>
                                        <option value="Admin">Admin</option>
                                        <option value="Guard">Guard</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
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
