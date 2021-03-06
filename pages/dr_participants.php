<!DOCTYPE html>
<?php 
session_start();
if ((!isset($_SESSION['user'])) or ($_SESSION['user_type'] != 1)) {
	header('Location: ../index.php');
}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FB4HO</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--Data Tables scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><b><em>FitnessBands</em></b>forHealthOutcomes</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php session_start(); echo "Dr. " . $_SESSION['last_name']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="./logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="dr_participants.php"><i class="fa fa-fw"></i>Participants</a>
                    <li>
                        <a href="dr_visualizations.php"><i class="fa fa-fw"></i>Visualizations</a>
                    </li>
                    <li>
                        <a href="dr_datatables.php"><i class="fa fa-fw"></i>Data Tables</a>
                    </li>
                    <li>
                        <a href="dr_addparticipant.php"><i class="fa fa-fw"></i>Add Participant</a>
                    </li>
                    <li>
                        <a href="dr_help.php"><i class="fa fa-fw"></i>Help</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            All Participants <small>Currently Registered</small>
                        </h1>
                    </div>
                </div>

                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-chart-o fa-fw"></i>Participants for <?php session_start(); echo "Dr. " . $_SESSION['last_name']; ?></h3>
                            </div>
                            <div class="panel-body">
                                <table id="example" class="display" width="100%"></table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!-- DISABLED TO ALLOW FOR D3/DATA TABLES <script src="js/jquery.js"></script> -->
    <!-- Bootstrap Core JavaScript -->
	<?php 
	include('util.php');
	session_start();
	if ((!isset($_SESSION['user'])) or ($_SESSION['user_type'] != 1)) {
		header('Location: index.php');
	}

	$doctorName = $_SESSION['last_name'];
	$conn = connect();
	$result = select($conn, "*", "users", "doctor='$doctorName'");
	mysql_close($conn);
	$dataSet = "[";
	$uid = "[";
	while($row = mysql_fetch_assoc($result)) {
	// User provided proper credentials
		//echo "<PRE>";
		//print_r($row);
		//echo  "</PRE>";
		$uid .= $row['uid'].',';
		$tUid = $row['uid'];
		$name = $row['first_name'];
		$dataSet .= '['."\""."<a href=./dr_visualizations.php?uid=$tUid&name=$name>".$row['username']."</a>\"".', ';
		$dataSet .= "\"".$row['first_name']."\"".', ';
		$dataSet .= "\"".$row['last_name']."\"".', ';
		$dataSet .= "\"".$row['date_of_birth']."\"".', ';
		$dataSet .= "\"".$row['gender']."\"".', ';
		$dataSet .= "\"".$row['band_id']."\"".']'.',';
	}
	$dataSet = rtrim($dataSet, ",");
	$uid  = rtrim($uid, ",");
	$uid .= ']';
	$dataSet .= ']';
	echo "
	    <script src=\"js/bootstrap.min.js\"></script>
	     <!-- Data Tables script -->
	    <script>
	    var dataSet = $dataSet;
	    var uid = $uid;"; 	
	?>

    $(document).ready(function() {
        $('#example').DataTable( {
            data: dataSet,
            columns: [
                { title: "Username" },
                { title: "First Name" },
                { title: "Last Name" },
                { title: "Birth Date" },
                { title: "Sex" },
                { title: "Band ID" }
            ]
        } );
    });
</script>

</body>

</html>
