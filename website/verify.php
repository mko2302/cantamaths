<?php
  include("dbconnect.php");
  // important to any page running sessions
  session_start();

  // can add error catching to see if its blank.
  $username = $_POST['username'];
  $password = $_POST['password'];

  $user_sql = "SELECT * FROM user WHERE username = '$username'";
  $user_qry = mysqli_query($dbconnect, $user_sql);


  // error catching
  if(mysqli_num_rows($user_qry)==0) {
    header("Location:index.php?page=login&error=fail");
  } else {

    // sends query
    $user_aa = mysqli_fetch_assoc($user_qry);
    $level = $user_aa['level']

    $hash_password = $user_aa['password'];
    if (password_verify($password, $hash_password)) {
      // if matches its starts a session
      if ($level == 2) {
        $_SESSION['admin'] = $username;
        header("Location: index.php?page=adminpanel");
      } elseif ($level == 1) {
        $_SESSION['active'] = $username;

      } elseif ($level == 0) {
        $_SESSION['inactive'] = $username;

      } else {
        header("Location:index.php?page=login&error=fail");
      };

    $username = $user_aa['username'];
    $userID = $user_aa['userID'];
  }
 ?>
