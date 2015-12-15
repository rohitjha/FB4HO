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

<link rel="stylesheet" type="text/css" href="d3.css">

  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
  $(function() {
  $( "#start_date" ).datepicker();
  });

$(function() {
    $( "#end_date" ).datepicker();
  });

</script>


</head>

<body>

<?php
include('util.php');
session_start();


$IsValidID = "Yes";

if ((!isset($_SESSION['user'])) or ($_SESSION['user_type'] != 1)) {
        header('Location: index.php');
}



// make sure they pass in a uid GET parameter
if (!isset($_GET['uid'])){
//        header('Location: index.php');


//make a static box or make it visible - here
$IsValidID = "No";


}//no uid found


// doctor's last name stored in the session - here
$patientUID = $_GET['uid'];

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

//read start and end time

$uid = $_GET["uid"];

$start_date = $_GET["start_date"];
$end_date = $_GET["end_date"];

$name = $_GET['name'];


?>

<script type="text/javascript">
var uid = "<?php echo $uid  ?>";
var name = "<?php echo $name ?>";
</script>


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
                    <li>
                        <a href="dr_participants.php"><i class="fa fa-fw"></i>Participants</a>
                    </li>
                    <li class="active">
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
                            <?php echo $name ?>
                        </h1>
                    </div>
                </div>




    <?php if ($IsValidID == "No"){ ?>
        <div id="content">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-chart-o fa-fw"></i> Search For a Patient:</h3>
                            </div>
                            <div class="panel-body">
                          
                                <div class="container">
                                    <div class='col-md-5'>
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker6'>
<form name=myform>
                                                <input type='text'  value="" class="form-control" placeholder="Patient Name" onclick="window.alert("Searching patient name in the database");"/>
</form>
<br>
<br>
<input type="submit" value="Search Database">
                                 
                                            </div>
                                        </div>
                                    </div>
				    <div class='col-md-5'>
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker7'>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          
                            </div>
                        </div>
                    </div>
                </div>


</div>
<?php }?>



		<?php if ($IsValidID == "Yes"){ ?>

                <!-- TIME INTERVAL FORM -->
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-chart-o fa-fw"></i> Time Interval</h3>
                            </div>
                            <div class="panel-body">
				<form action="dr_visualizations.php" method="GET">
                                <div class="container">
                                    <div class='col-md-5'>
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker6'>
                                                <input type='text' name="start_date" id="start_date" value="" class="form-control" placeholder="Start Date" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-5'>
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker7'>
                                                <input type='text' id="end_date" name="end_date" value="" class="form-control" placeholder="End Date"/>
						<input type="hidden" name="uid" value="<?php echo $uid  ?>">
						<input type="hidden" name="name" value="<?php echo $name  ?>">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-5'>
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker7'>
						<input type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
				</form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

<?php }?>



                 <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Average Heart Rate</h3>
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
                                <h3 class="panel-title"><i class="fa fa-chart-o fa-fw"></i> Total Calories burned per hour</h3>
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
    
    <!--NEED PHP TO SELECT DATA FROM SPECIFIED TIME RANGE AND STORE IN ASSOCIATIVE ARRAY FOR D3-->

    <!-- jQuery -->
   <!-- <script src="js/jquery.js"></script>-->
    <!-- Bootstrap Core JavaScript -->
   <!-- <script src="js/bootstrap.min.js"></script>-->

   <!-- D3 Files -->
   <script src="http://d3js.org/d3.v3.min.js"></script>
   <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>

<script type="text/javascript">
var graph_data = "<?php echo $js_data  ?>";
var time_type = "Month";

var start_date = "<?php echo $start_date  ?>";
var end_date = "<?php echo $end_date  ?>";

if (start_date != "")
{
_b = start_date.split("/");
_c = _b[2] + "-" + _b[0] + "-" + _b[1];
start_date = _c + " 00:00:00";
}

if (end_date != "")
{
_b = end_date.split("/");
_c = _b[2] + "-" + _b[0] + "-" + _b[1];
end_date = _c + " 00:00:00";

}

</script>

<script type="text/javascript" src="d3_code_graph1.js"></script>
<script type="text/javascript" src="d3_code_graph2.js"></script>
<script type="text/javascript" src="d3_code_graph3.js"></script>



</body>

</html>

