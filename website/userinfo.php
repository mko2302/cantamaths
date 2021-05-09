<?php
$_SESSION['user'] = $username;

$user_sql = "SELECT * FROM user WHERE username = '$username'";
$user_qry = mysqli_query($dbconnect, $user_sql);

$access = $user_aa['access'];
$firstname = $user_aa['firstname'];
$lastname = $user_aa['lastname'];

 ?>
