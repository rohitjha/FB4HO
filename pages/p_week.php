<!DOCTYPE html>
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

<link rel="stylesheet" type="text/css" href="d3.css">


</head>

<body>

<?php
include('util.php');
session_start();
if ((!isset($_SESSION['user'])) or ($_SESSION['user_type'] != 0)) {
        header('Location: index.php');
}




// doctor's last name stored in the session
$patientUID = $_SESSION['uid'];

$conn = connect();

$SQL = "SELECT * FROM data WHERE uid='" . $patientUID . "'";
$result = mysql_query($SQL);

//echo "<br>";

//$result = json_encode($result);

//echo $result;

$js_data = "";

while ( $db_field = mysql_fetch_assoc($result) ) {

//print $db_field['value'] . "<BR>";
//echo $db_field['timestamp'] . " <br> ";
//echo $db_field['data_type'] . " <br> ";
//echo $db_field['value'] . " <br><br><br> ";

$js_data .= $db_field['timestamp'] . " " . $db_field['data_type'] . " " . $db_field['value'] . " ";

}//while

//echo $js_data;


//$result = select($conn, "*", "data", "uid='$patientUID'");
//echo $result;

mysql_close($conn);

?>



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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
<?php session_start(); echo " " . $_SESSION['user'];?>
<b class="caret"></b></a>
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
                    <li>
                        <a href="p_day.php"><i class="fa fa-fw"></i>Day</a>
                    </li>
                    <li class="active">
                        <a href="p_week.php"><i class="fa fa-fw"></i>Week</a>
                    </li>
                    <li>
                        <a href="p_month.php"><i class="fa fa-fw"></i>Month</a>
                    </li>
                    <li>
                        <a href="p_help.php"><i class="fa fa-fw"></i>Help</a>
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
                            This Week
                        </h1>
                    </div>
                </div>

                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-chart-o fa-fw"></i> Average Heart Rate per hour</h3>
                            </div>
                            <div class="panel-body">
                                <h1>Heart Rate</h1>
                                <div class="d3_graphs" id = "graph1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                 <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Total Steps taken per day</h3>
                            </div>
                            <div class="panel-body">
                                <h1>Steps Taken</h1>
                                <div class="d3_graphs" id = "graph2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                 <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Total Calories burned per day</h3>
                            </div>
                            <div class="panel-body">
                                <h1>Calories Burned</h1>
                               <div class="d3_graphs" id = "graph3"></div>
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
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


 <!-- D3 Files -->
   <script src="http://d3js.org/d3.v3.min.js"></script>
   <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>

<script type="text/javascript">
var graph_data = "<?php echo $js_data  ?>";
var time_type = "Week";

start_date = "";
end_date = "";


</script>

<script type="text/javascript" src="d3_code_graph1.js"></script>
<script type="text/javascript" src="d3_code_graph2.js"></script>
<script type="text/javascript" src="d3_code_graph3.js"></script>



</body>

</html>
