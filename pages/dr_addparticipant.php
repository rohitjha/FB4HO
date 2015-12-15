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
                    <li class="active">
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
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-chart-o fa-fw"></i> Participant Form</h3>
                            </div>
                            <div class="panel-body">
			<?php
			
			if (isset( $_GET['code'])) {
				$c = $_GET['code'];
				$url = 'https://login.live.com/oauth20_token.srf?client_id=000000004416F809&redirect_uri=http://ec2-52-8-59-225.us-west-1.compute.amazonaws.com/pages/dr_addparticipant.php&client_secret=c00TsJ3adPPG9LHWTCZGuo6lGIg5t1G4&code=' . $c .  '&grant_type=authorization_code';
				
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_URL, $url ); //Url together with parameters
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 7); //Timeout after 7 seconds
				//curl_setopt($ch, CURLOPT_USERAGENT , 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)');
				curl_setopt($ch, CURLOPT_HEADER, 0);    
				$result = curl_exec($ch);
				curl_close($ch);
				
				$results = json_decode($result, true);
				$access_token = $results['access_token'];
				$refresh_token = $results['refresh_token'];		
				} 
				
			$html1 = "
			<!DOCTYPE HTML PUBLIC '-//IETF//DTD HTML 3.2//EN'>
			<HEAD>
			 <meta charset='utf-8' />
			    <title>Add Patient</title>
			    <script src='scripts/microsofthealth.js'></script>
			    <!--<link href='css/sample.css' rel='stylesheet' />--!>
			    <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			    <script>
				var mshealth = new MicrosoftHealth({
				    clientId: '000000004416F809',
				    redirectUri: 'http://ec2-52-8-59-225.us-west-1.compute.amazonaws.com/pages/dr_addparticipant.php',
				    scope: 'mshealth.ReadProfile mshealth.ReadDevices mshealth.ReadActivityHistory mshealth.ReadActivityLocation offline_access',
						response_type: 'code'
				});
			    </script>
			    <script>
			    function setTokens() {
				var x = '$access_token';
				if (x != '') {
					document.getElementById('access').value = '". $access_token . "';
					document.getElementById('access').readOnly = true;
					document.getElementById('refresh').value = '". $refresh_token . "'; 
					document.getElementById('refresh').readOnly = true;
					document.getElementById('register').disabled = false;
					}
				}
				function getCode() {
					var query = document.location.search.substring(1);
					if (query) {
						var c = query.split('=')[1];
						var loginUrl = 'https://login.live.com/oauth20_token.srf?client_id=000000004416F809&redirect_uri=http://ec2-52-8-59-225.us-west-1.compute.amazonaws.com/pages/dr_addparticipant.php&client_secret=c00TsJ3adPPG9LHWTCZGuo6lGIg5t1G4&code=' + c + '&grant_type=authorization_code';
						console.log(c);
						console.log(loginUrl);
						document.getElementById('step2').style.visibility = 'visible'; 
						}
					}
				</script>
			</HEAD>
			<BODY onload='getCode(); setTokens();' BGCOLOR='WHITE'>
			<h2 ALIGN='CENTER'> Step 1: Authenticate Microsoft Health App</h2>
			<p ALIGN='CENTER'><button  type='button' onclick='mshealth.login()'>Authenticate</button></p>

			<div id='step2' style='visibility: hidden;'>
			<h2 ALIGN='CENTER'> Step 2: Enter Patient Information</h2>
			<TABLE ALIGN='CENTER'>
			<TR><TD>
			<FORM ACTION='/pages/create_patient.php' METHOD='POST'>
			<TABLE CELLPADDING=5>
			<TR><TD>First Name:</TD><TD><INPUT TYPE='TEXT' NAME='FIRST'></TD></TR>
			<TR><TD>Last Name:</TD><TD><INPUT TYPE='TEXT' NAME='LAST'></TD></TR>
			<TR><TD>Username:</TD><TD><INPUT TYPE='TEXT' NAME='USER'></TD></TR>
			<TR><TD>Password:</TD><TD><INPUT TYPE='PASSWORD' NAME='PASS'></TD></TR>
			<TR><TD>Date of Birth:</TD><TD><INPUT TYPE='TEXT' NAME='DOB' PLACEHOLDER='        YYYY-MM-DD'></TD></TR>
			<TR><TD>Health Account Email:</TD><TD><INPUT TYPE='TEXT' NAME='EMAIL'></TD></TR>
			<TR><TD>Band ID:</TD><TD><INPUT TYPE='TEXT' NAME='BANDID'></TD></TR>
			<TR><TD>Gender:</TD><TD><input type='radio' name='GENDER' value='female'> Female
			<input type='radio' name='GENDER' value='male'> Male</TD></TR>
			<TR><TD>Access Token</TD><TD><INPUT TYPE='TEXT' NAME='ATOKEN' id='access' maxlength='10000'></TD></TR>
			<TR><TD>Refresh Token</TD><TD><INPUT TYPE='TEXT' NAME='RTOKEN' id='refresh' maxlength='10000'></TD></TR>
			<TR><TD align='right'><INPUT TYPE='submit' VALUE='Submit' id='register' ></TD></TR>
			</TABLE>
			</FORM>
			</TD></TR>
			</TABLE>";
				
				echo $html1; 
			?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                    </div>
                </div>

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
