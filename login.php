<?php
include('util.php');
// The login.php is invoked when the user is either trying to create a new
// account or to login. If it's the former, the NEW parameter will be set.
// To send a user to a different page (after possibly executing some code,
// you can use the statement:
//
//     header('Location: view.php');
//
// This will send the user to view.php. To use this mechanism, the
// statement must be executed before any of the document is output.

// Reference for PHP connect and query from: http://php.net/manual/en/pgsql.examples-basic.php

// Simple has select grant on tables: auth and msg.

if ($_POST['USER'] == "" or $_POST['PASS'] == "" ) {
	echo "
	<DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 3.2//EN\">
	<HEAD>
	<TITLE>fb4ho</TITLE>
	</HEAD>	
	<BODY BGCOLOR=WHITE>
	<TABLE ALIGN=\"CENTER\">
	<TR><TD>
	<IMG SRC='title.gif' WIDTH=500px HEIGHT=100px/>
	</TD></TR>
	<TR><TD>
	<H2> Please enter a user name and or password. </H2>
	<a href=\"index.php\">Back</a>
	</TD></TR>
	</TABLE>
	</BODY>";
	exit();
}
		
#if(isset($_POST['NEW'])) {
#	// Your new user creation code goes here. If the user name
#	// already exists, then display an error. Otherwise, create a new
#	// user account and send him to view.php.
#	$sconn = connect_simple();
#	$user = pg_escape_string($_POST['USER']); // make the string safe 
#	$pass = md5($_POST['PASS']);
#	$result = select($sconn, "*", "auth", "user_name='$user'");
#	while($row = pg_fetch_array($result)) {
#		// If the user being created already exists 
#		if ($row['user_name'] == $user){ 
#			$pUser = $_POST['USER'];
#			echo "
#			<DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 3.2//EN\">
#			<HEAD>
#			<TITLE>Chattr</TITLE>
#			</HEAD>	
#			<BODY BGCOLOR=WHITE>
#			<TABLE ALIGN=\"CENTER\">
#			<TR><TD>
#			<H1>Chattr</H1>
#			</TD></TR>
#			<TR><TD>
#			<H2> User $pUser already exists! </H2>
#			<a href=\"index.php\">Back</a>
#			</TD></TR>
#			</TABLE>
#			</BODY>";
#			exit();
#		}
#	}
#	// The user does not exist 
#	pg_close(sconn);
#	$conn = connect_student();
#	insert($conn, "auth","user_name, password" ,"'$user', '$pass'");
#	pg_close($conn);
#	create_session($user);
#	header('Location: view.php');
#	exit();
#	
#} else {
$conn = connect();
$user = $_POST['USER']; // make the string safe 
$pass = md5($_POST['PASS']);
#$pass = $_POST['PASS'];
$result = select($conn, "*", "users", "username='$user' AND password='$pass'");
mysql_close($conn);
while($row = mysql_fetch_assoc($result)) {
// User provided proper credentials
	echo "<pre>";
	print_r($row);
	echo  "</pre>";
	if ($row['username'] == $user) {
		destroy_session($user);		// if user is logging in twice w/o logging out
		create_session($user, $row['user_type'], $row['last_name'], $row['uid']);
		if ($row['user_type'] == 1) {
			header('Location: pages/dr_participants.php');
		} else if ($row['user_type'] == 0) {
			header('Location: pages/p_day.php');
		}
		exit();
	}
}
// user failed to log in 
echo "
<DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 3.2//EN\">
<HEAD>
<TITLE>fb4ho</TITLE>
</HEAD>	
<BODY BGCOLOR=WHITE>
<TABLE ALIGN=\"CENTER\">
<TR><TD>
<IMG SRC='title.gif' WIDTH=500px HEIGHT=100px/>
</TD></TR>
<TR><TD>
<H2> Login Failed! </H2>
<a href=\"index.php\">Back</a>
</TD></TR>
</TABLE>
</BODY>";
exit();

?>
