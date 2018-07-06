<?php
	session_start();
	include('../include/db.php');
	if(! (isset($_SESSION['UID']))){
		header("Location:index.php");
    }
    $visitors = mysql_query("SELECT * FROM visitors LEFT JOIN visit ON visitors.id = visit.visitor_id LEFT JOIN session_codes ON visit.session_code = session_codes.code WHERE visitors.id=".$_REQUEST['id'],$con);

	$row = mysql_fetch_array($visitors);
    
    $uid = $_SESSION['UID'];
    $code = $row['code'];
    $vid = $row['visitor_id'];

    mysql_query("INSERT INTO sessions(visitor_id,user_id,code,created_at,updated_at) VALUES('$vid','$uid','$code',NOW(),NOW()) ",$con);
    mysql_query("UPDATE session_codes SET status = 1,logged_out_by = '$uid' WHERE code=".$row['code']." AND status = 0 AND phone = ".$row['phone'],$con);
    if(mysql_error()==""){
        header("Location:visitors.php");
    }
    else{
        echo mysql_error(). '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
    }
    ?>
                                