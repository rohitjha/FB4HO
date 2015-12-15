<?php
include('util.php');

session_start();

#check if logged in
if (!isset($_SESSION['user'])){ 
	header('Location: index.php');
}
# check if patient
if (isset($_SESSION['user']) and ($_SESSION['user_type'] == 0)){ 
	header('Location: patient_home.php');
}

$first = $_POST['FIRST'];
$last = $_POST['LAST'];
$user = $_POST['USER']; 
$pass = md5($_POST['PASS']);
$dob = $_POST['DOB'];
$email = $_POST['EMAIL'];
$band_id = $_POST['BANDID'];
$gender = $_POST['GENDER'];
$access = $_POST['ATOKEN'];
$refresh = $_POST['RTOKEN'];

$conn = connect();
if (!$conn) {
  echo "Unable to connect to database.\n";
  exit;
}

if (isset($_SESSION['user']) and ($_SESSION['user_type'] == 1)){ 
	$doc_last = $_SESSION['last_name'];
}


$result = insert($conn,"users", "username, first_name, last_name, password, user_type, band_id, date_of_birth, gender, doctor, initalized, token, refresh_token", "'$user', '$first', '$last', '$pass', 0, '$band_id', '$dob', '$gender', '$doc_last', 1, '$access', '$refresh'" );
mysql_close($conn);

if ($result != '') {
	echo "Failed to add patient to database";
}

echo "<script type=\"text/javascript\">
alert(\"Patient $first $last successfully added!\");
window.location.href = \"./dr_participants.php\";
</script>";

exit();

?>
