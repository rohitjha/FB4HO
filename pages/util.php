<?php
//reutrns a mysql  connection 
function connect() {
	$sconn = mysql_connect("127.0.0.1", "root", "cse210_root") or die('Could not connect: ' . mysql_error());
	$db_selected = mysql_select_db("fb4ho", $sconn);
	if (!$db_selected) {
		die('Unable to use fb4ho: '.mysql_error());
	}
	return $sconn;
}

// inserts into the specified database and table.
function insert($conn, $table, $cols, $values) {
	$query = "INSERT INTO $table ($cols) VALUES($values);";
	$result = mysql_query($query, $conn) or die('Query failed: ' . mysql_error());
	return;
}

// deletes from the database <we probably won't be using this>
function delete($conn, $table, $values) {
	$query = "DELETE FROM $table WHERE $values;";
	$result = mysql_query($query, $conn) or die('Query failed: ' . mysql_error());
	return;
}

//perform an SQL select
// Required: mysqlconn, colums, table, options
// if options is "" then select colums from table is run 
// if options is filled out then select colums from table where options is run
function select($conn, $col, $table, $option) {
	if ( $option != "" ) {
		$query = "SELECT $col FROM $table WHERE $option;";  
	}
	else {
		$query = "SELECT $col FROM $table ;";
	}
	$result = mysql_query($query, $conn) or die('Query failed: ' . mysql_error());
	return $result;
}


// This will be called when a user correctly logs in 
// Creates a new session id and sets the $_SESSION vars user to the user 
// stores the SID and user into the 'sessions' table to be used for checking
//	logged in users.
function create_session($user, $userType, $DrlastName, $uid) {
	session_start();
	session_regenerate_id();
	$sid = session_id();
	// set session variables
	$_SESSION['user'] = $user;
	$_SESSION['last_name'] = $DrlastName;
	$_SESSION['user_type'] = $userType;
	$_SESSION['id'] = $sid;
	$_SESSION['uid'] = $uid;
	return;
}


//used to log user out 
function destroy_session() {
	$sid = session_id();
	$user = $_SESSION['user'];
	session_unset();
	session_destroy();
	return;
}

?>
