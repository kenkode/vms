<?php
	session_start();
	if($_REQUEST['phone'] == ''){
		header("Location:index.php");
	}
	// if(isset($_SESSION['UID'])){
	// 	header("Location:dashboard/");
	// }
?>
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
							<h1 class="panel-title">Visitor's Form</h1>
						</div>
						<div class="panel-body">
							<div class="conatiner">
								<div class="row" style="font-family: 'Baloo Bhaina', cursive;">
								    <form method="POST">
									<?php
									function cleanURL($textURL) {
										$URL = strtolower(preg_replace( array('/[^a-z0-9\- ]/i', '/[ \-]+/'), array('', ''), $textURL));
												  return $URL;
								    }
									include('include/db.php');
									if(isset($_POST['name'])){
									$code = trim($_POST['code']);
									$check = mysql_query("SELECT * FROM session_codes WHERE code='$code' ",$con);
									if(mysql_num_rows($check)==0){
										echo '<p style="color: #D8000C;font-weight: bold;">Your code does not exist in the system! Please try to resend the code to get a new one.</p>';
									}else{
									   $name = trim($_POST['name']);		
									   $phone = trim($_REQUEST['phone']);
									   $phone = preg_replace('/^254/','+254',$_REQUEST['phone']);
									   $idno = trim($_POST['idno']);		
									   $department = trim($_POST['department']);
									   $type_of_visit = trim($_POST['type_of_visit']);
									   mysql_query("INSERT INTO visitors(name,phone,id_number,is_loggedin,created_at,updated_at) VALUES('$name','$phone','$idno',1,NOW(),NOW()) ",$con);
									   if(mysql_error()==""){
									    	mysql_query("INSERT INTO visit(department,type_of_visit,date,visitor_id,session_code,created_at,updated_at) VALUES('$department','$type_of_visit','".date("Y-m-d")."',LAST_INSERT_ID(),'$code',NOW(),NOW()) ",$con);
										    header("Location:booking.php?phone=".cleanURL($phone));
									   }
									   else{
										   echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
									   }
									}
									}
									?>
                                    <div class="row">
										<div class="col-sm-2"></div>
										<div class="form-group col-sm-8">
											<label>Phone Number : </label>
											<label><?php echo $_REQUEST['phone'] ?></label>
										</div>
										<div class="col-sm-3"></div>
									    </div>
										<div class="row">
										<div class="col-sm-2"></div>
										<div class="form-group col-sm-8">
											<label>Full Name</label>
											<input type="text" required placeholder="Please enter your full name" class="form-control" name="name" id="name" autocomplete="off" />
										</div>
										<div class="col-sm-3"></div>
									    </div>
										<div class="row">
											<div class="col-sm-2"></div>
											<div class="form-group col-sm-8">
												<label>National Identity Number</label>
												<input type="text" required placeholder="Please enter your national identity number" class="form-control" name="idno" id="idno" autocomplete="off" />
											</div>
											<div class="col-sm-3"></div>
										</div>
										<div class="row">
											<div class="col-sm-2"></div>
											<div class="form-group col-sm-8">
												<label>Department to visit</label>
												<input type="text" required placeholder="Please enter department to visit" class="form-control" name="department" id="department" autocomplete="off" />
											</div>
											<div class="col-sm-3"></div>
										</div>
										<div class="row">
											<div class="col-sm-2"></div>
											<div class="form-group col-sm-8">
												<label>Type of visit</label>
												<textarea rows="5" required placeholder="Please enter your type of visit" class="form-control" name="type_of_visit" id="type_of_visit"></textarea>
											</div>
											<div class="col-sm-3"></div>
										</div>		        	
										<div class="row">
											<div class="col-sm-2"></div>
											<div class="form-group col-sm-8">
												<label>SMS Code</label>
												<input type="text" required placeholder="Please enter sms code sent to your phone" class="form-control" name="code" id="code" autocomplete="off" />Click <a href="resend.php?phone=<?php echo $_REQUEST['phone'] ?>">Resend Code</a> incase you didn't get sms code
											</div>
											<div class="col-sm-3"></div>
										</div>
								    	<div class="modal-footer">
											<div class="col-sm-6">
												<input type="submit" value="Book" name="submit" class="btn btn-success" id="regBtn" />
											</div>
										    <div class="col-sm-6">
											   <a href="index.php" class="btn btn-danger" id="resetBtn">Back</a>
										    </div>
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