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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php session_start(); echo " Dr. " . $_SESSION['last_name']; ?><b class="caret"></b></a>
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
                    <li>
                        <a href="dr_visualizations.php"><i class="fa fa-fw"></i>Visualizations</a>
                    </li>
                    <li>
                        <a href="dr_datatables.php"><i class="fa fa-fw"></i>Data Tables</a>
                    </li>
                    <li>
                        <a href="dr_addparticipant.php"><i class="fa fa-fw"></i>Add Participant</a>
                    </li>
                    <li class="active">
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
                            Help <small>Info</small>
                        </h1>
                    </div>
                </div>

                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-chart-o fa-fw"></i> Info</h3>
                            </div>
                            <div class="panel-body">
                                <p><h3>A. Syncing a Microsoft Band with a Patient's Phone</h3></p>
				<p>
				    <ol>
					<li>Follow the instructions written <a href="http://www.microsoft.com/microsoft-band/en-us/support/hardware/connect-microsoft-band" target="_blank">here</a> to pair a fitness band with the patient’s cell phone.</li>
					<li>Authorize the application to access patient’s profile and activity information follow the steps mentioned <a href="https://www.microsoft.com/microsoft-band/en-us/support/tiles/connected-apps" target="_blank">here</a>.</li>
				    </ol>
				</p>
                                <p><h3>B. Adding a New Participant</h3>
				    <ol>
					<li>Sync the patient’s Microsoft Band with the Microsoft Health mobile application on their cell phone. (See A above)</li>
					<li>Login to your account on the FitnessBandsforHealthOutcomes web application.</li>
					<li>On the Add Participant tab, in Step 1 ask the participant to Authorize FitnessBandsforHealthOutcomes to access their fitness data. If the Access Token and Refresh Token textboxes are populated then the authorization was successful.</li>
					<li>Next, in Step 2 add the following details for the patient:
						<ul>
						    <li>First Name</li>
						    <li>Last Name</li>
						    <li>Username</li>
						    <li>Password</li>
						    <li>Date of Birth</li>
						    <li>Health account email</li>
						    <li>Band ID</li>
						    <li>Gender</li>
						</ul>
					</li>
				    </ol>
				</p>
				<p><h3>C. Viewing Participants' Fitness Information</h3>
				    <ol>
					<li>Login to your account on the FitnessBandsforHealthOutcomes web application.</li>
					<li>To view all participants registered with you, go to the Participants tab. From here you can click on a participant to view their heart rate, steps taken and calories burned through graphs for a specified time range</li>
					<li>Alternately, you can view all the fitness data of all patients in a tabular form on the Data Tables tab</li>
				    </ol>
				</p>
				
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

</body>

</html>
