<html>
	<head>
		<title>VMS</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/custom.css">
		<link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6 text-center">
			  	<h1 class="title"> <img src="images/vms.jpg" width="250" height="100"/><br>Visitor Management System (VMS)</h1>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="panel-title">Welcome To Visitor Management System (VMS)</h1>
						</div>
						<div class="panel-body">
							<div class="conatiner">
								<div class="row" style="font-family: 'Baloo Bhaina', cursive;">
								    <form method="POST">
									  <div class="col-sm-12 form-group">
										<?php
											session_start();
											// if(isset($_SESSION['UID'])){
											// 	header("Location:dashboard/");
											// }
											include('include/db.php');		
											if(isset($_POST['phone'])){
												$phone = trim($_POST['phone']);
												
												if (preg_match("~^0\d+$~", $phone)) {
													// Yes
													$phone = preg_replace('/^0/','+254',$phone);
												}
												else if (preg_match("~^254\d+$~", $phone)){
													$phone = preg_replace('/^254/','+254',$phone);
												}
												else if (preg_match('/^\+254?\d+$/', $phone)){
													$phone = $phone;
												}
												else{
													echo '<p style="color: #D8000C;font-weight: bold;">Invalid Phone Number.</p>';
												}
												//echo(rand(1111,9999));
												// echo	$phone;
												//exit(); 
										  	$code = rand(1111,9999);
												//if user is already registerd
													// mysql_query("INSERT INTO session_codes(phone,code,created_at,updated_at) VALUES('$phone','$code',NOW(),NOW()) ",$con);
													// if(mysql_error()==""){
													//   	header("Location:user-details.php");
													// }
													// else{
													// 	echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
													// }
													include('include/sms.php');
											}			
										?>
										<label><strong>Enter Your Phone Number:</strong></label>
										<input type="text" name="phone" required placeholder="Please enter your phone number" class="form-control"/>
									  </div>
									  <div class="col-sm-12 form-group">
										<button id="next" class="btn btn-lg btn-info">Next</button>
									  </div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
				</div>
			</div>
		</div>
		
		<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		
	</body>
</html>