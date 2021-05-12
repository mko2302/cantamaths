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
    header("Location:index.php?page=login&error=error");
  } else {
    // sends query
    $user_aa = mysqli_fetch_assoc($user_qry);
    $access = $user_aa['access'];

    $access = $user_aa['access'];
    $hash_password = $user_aa['password'];

    if (password_verify($password, $hash_password)) {
      // if matches its starts a session
      if ($access == 2) {
        $_SESSION['admin'] = $username;
        header("Location: index.php?page=adminpanel");
      } elseif ($access == 1 Or 0) {
        $_SESSION['user'] = $username;
        header("Location: index.php?page=profile");

      } else {
        header("Location:index.php?page=profile");
      };

      $username = $user_aa['username'];
      $userID = $user_aa['userID'];
    } else {
      header("Location:index.php?page=login&error=fail");
    }
    };
 ?>
