<?php

$username = $_SESSION['user'];

$user_sql = "SELECT * FROM user WHERE username = '$username'";
$user_qry = mysqli_query($dbconnect, $user_sql);
$user_aa = mysqli_fetch_assoc($user_qry);

$access = $user_aa['access'];
$firstname = $user_aa['firstname'];
$lastname = $user_aa['lastname'];

 ?>
