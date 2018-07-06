<?php
	session_start();
	include('../include/db.php');
	if(! (isset($_SESSION['UID']))){
		header("Location:index.php");
    }
    $visitors = mysql_query("SELECT * FROM visitors LEFT JOIN visit ON visitors.id = visit.visitor_id LEFT JOIN session_codes ON visit.session_code = session_codes.code WHERE visitors.id=".$_REQUEST['id'],$con);

	$row = mysql_fetch_array(mysql_query("SELECT count(*) FROM visitors"));
    $visitorsCount = $row[0];
    
    $uid = $_SESSION['UID'];
    $code = $_SESSION['code'];
    $vid = $row['visitor_id'];

    mysql_query("INSERT INTO sessions(visitor_id,user_id,code,created_at,updated_at) VALUES('$vid','$uid','$code',NOW(),NOW()) ",$con);
    mysql_query("UPDATE session_codes status = 1 WHERE code=".$row['code']." AND status = 0 AND phone = ".$row['phone'],$con);
    if(mysql_error()==""){
        header("Location:visitors.php");
    }
    else{
        echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
    }
    ?>
                                