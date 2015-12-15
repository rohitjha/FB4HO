<?php
include('util.php');
session_start();

if (isset($_SESSION['user'])) {
	destroy_session();
}
header('Location: ../index.php');

// Your logout code goes here.

?>
