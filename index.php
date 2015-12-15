<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FB4HO</title>

    <!-- Bootstrap core CSS -->
    <link href="pages/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="pages/css/signin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="pages/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  </head>

  <body style="background-color: #fff;">

  	<?php
	include('util.php');
	session_start();
	#echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
	# check if they are already loged in and a doctor
	if (isset($_SESSION['user']) and ($_SESSION['user_type'] == 1)){ 
		header('Location: pages/dr_participants.php');
	}
	# check if they are alredy logged in and a patient
	else if (isset($_SESSION['user']) and ($_SESSION['user_type'] == 0)){ 
		header('Location: pages/p_day.php');
	}
	?>
    <div class="container">

      <TABLE ALIGN="CENTER">
      <TR><TD>
      <IMG SRC="title.gif" WIDTH=500px HEIGHT=100px/>
      </TD></TR>
      </TABLE>

      <form class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" class="sr-only">Email address</label>
        <input type="text" NAME="USER" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" NAME="PASS" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" formmethod="post" formaction="login.php">Sign in</button>
      </form>
    </div> <!-- /container -->

  </body>
</html>

