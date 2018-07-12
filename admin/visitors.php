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
?>
<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/dashboard_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:12:22 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VMS</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/buttons.dataTables.min.css" rel="stylesheet">

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
            
                <li class="active">
                    <a href="visitors.php"><i class="fa fa-users"></i> <span class="nav-label">Visitors</span></a>
                </li>

                <li>
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
                <h5>Visitors</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <!-- <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul> -->
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
            
            <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Identity Number</th>
                <th>Department to visit</th>
                <th>Type of visit</th>
                <th>Date of visit</th>
                <th>Time Left</th>
                <th>Logged out by</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $visitors = mysql_query("SELECT name,session_codes.phone,visit.visitor_id,id_number,visit.created_at,department,type_of_visit,session_codes.code FROM visitors LEFT JOIN visit ON visitors.id = visit.visitor_id LEFT JOIN session_codes ON visit.session_code = session_codes.code ",$con);
            echo mysql_error();
            while($row = mysql_fetch_array($visitors)) {
            ?>
            <tr class="gradeX">
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td><?php echo $row['id_number'] ?></td>
                <td><?php echo $row['department'] ?></td>
                <td><?php echo $row['type_of_visit'] ?></td>
                <td><?php echo $row['created_at'] ?></td>
                <td>
                <?php 
                $sessions = mysql_query("SELECT * FROM sessions LEFT JOIN users ON sessions.user_id = users.id WHERE visitor_id=".$row['visitor_id']." AND code = ".$row['code'],$con);
                    if(mysql_num_rows($sessions) > 0){
                        $row1 = mysql_fetch_array($sessions);
                        echo $row1['created_at'];
                    }else{
                        echo 'Not Left';
                    } 
                ?>
                </td>
                <td>
                <?php 
                    if(mysql_num_rows($sessions) > 0){
                        echo $row1['name'];
                    }else{
                        echo '';
                    } 
                ?>
                </td>
            </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Identity Number</th>
                <th>Department to visit</th>
                <th>Type of visit</th>
                <th>Date of visit</th>
                <th>Time Left</th>
                <th>Logged out by</th>
            </tr>
            </tfoot>
            </table>

            </div>
            </div>
            </div>
            </div>

        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> VMS &copy; 2014-2015
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Data Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.buttons.min.js"></script>
    <script src="js/plugins/dataTables/jszip.min.js"></script>
    <script src="js/plugins/dataTables/pdfmake.min.js"></script>
    <script src="js/plugins/dataTables/vfs_fonts.js"></script>
    <script src="js/plugins/dataTables/buttons.html5.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <style>

    </style>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.html', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );

        }
    </script>

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:14:37 GMT -->
</html>
