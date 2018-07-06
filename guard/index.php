<?php
	session_start();
	include('../include/db.php');
	if(isset($_SESSION['UID'])){
		header("Location:dashboard.php");
	}
	// $row = mysql_fetch_array(mysql_query("SELECT count(*) FROM visitors"));
	// $personsCount = $row[0];
?>
<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/login_two_columns.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:14:14 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VMS</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown" style="margin-left:650px !important; margin-top:100px !important">
        <div class="row">
            <div class="col-md-6">
                <div class="ibox-content">
                    <h3>Login</h3>
                    <form class="m-t" role="form" method="post">
                        <?php
                            if(isset($_POST['username'])){
                            $username = trim($_POST['username']);		
                            $password = md5($_POST['password']);
                            if(strlen($username) > 0 && strlen(trim($_POST['password'])) > 0){
                                $check = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password' ",$con);
                                if(mysql_num_rows($check)==1){
                                    //fetch details				
                                    $row = mysql_fetch_assoc($check);
                                    $_SESSION['UID'] = $row['id'];
                                    $_SESSION['name'] = $row['name'];
                                    $_SESSION['username'] = $row['username'];
                                    $_SESSION['user_level'] = $row['user_level'];
                                    
                                    //success
                                    echo '<p style="color: #4F8A10;font-weight: bold;">Login Successful. Redirecting...</p>';
                                    header("Location:dashboard.php");				
                                }
                                else{				
                                    echo '<p style="color: #D8000C;font-weight: bold;">Invalid Credentials.</p>';
                                }	
                            }
                            else{
                                echo '<p style="color: #D8000C;font-weight: bold;">Please Fill All The Details.</p>';
                            }
                            }   
                        ?>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Username" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required="">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                        <a href="#">
                            <small>Forgot password?</small>
                        </a>
                    </form>
                    <p class="m-t">
                        <small>Copyright VMS &copy; 2014</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
    </div>

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/login_two_columns.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:14:14 GMT -->
</html>
