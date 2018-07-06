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
									  <div class="col-sm-12 form-group">
										<?php
                                            include('include/db.php');
                                           
                                            $visitor = mysql_query("SELECT * FROM visitors WHERE phone=".$_REQUEST['phone'],$con);
                                            //echo "SELECT * FROM visitors WHERE phone='".$_REQUEST['phone']."' ";
                                            $row = mysql_fetch_array($visitor);
                                            $visit = mysql_query("SELECT * FROM visit LEFT JOIN session_codes on visit.session_code = session_codes.code WHERE visitor_id='".$row['id']."' AND status= 0 ",$con);
                                            $row1 = mysql_fetch_array($visit);
                                            			
										?>
                                        <h3><img src="images/if_success_47715.png" width="150" height="150"/><br>Appointment Booked Successfully!</h3>
                                        <h4>Appointment Details</h4>
                                        <table border="1" cellpadding="5" width="520">
                                        <tr>
                                        <td>Name:</td><td><?php echo $row['name']?></td>
                                        <td>Phone:</td><td><?php echo $row['phone']?></td>
                                        </tr>
                                        <tr>
                                        <td>Identity Number:</td><td><?php echo $row['id_number']?></td>
                                        <td>Department:</td><td><?php echo $row1['department']?></td>
                                        </tr>
                                        <tr>
                                        <td>Type of visit:</td><td><?php echo $row1['type_of_visit']?></td>
                                        <td>Date:</td><td><?php echo $row1['date']?></td>
                                        </tr>
                                        </table>
									  </div>
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