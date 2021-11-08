<?php
  include("dbconnect.php");
  // important to any page running sessions
  session_start();

  // can add error catching to see if its blank.
  $username = $_POST['username'];
  $password = $_POST['password'];

  $user_sql = "SELECT * FROM user JOIN access ON user.accessID = access.accessID WHERE username = '$username'";
  $user_qry = mysqli_query($dbconnect, $user_sql);

  // error catching
  if(mysqli_num_rows($user_qry)==0) {
    header("Location:index.php?page=login&status=loginerror");
  } else {
    // sends query
    $user_aa = mysqli_fetch_assoc($user_qry);
    $access = $user_aa['accessID'];
    $hash_password = $user_aa['password'];

    if (password_verify($password, $hash_password)) {
      // if matches its starts a session
      if ($access == 1) {
        //start admin session
        $_SESSION['admin'] = $username;
        // redirect to admin panel
        // header("Location: index.php?page=adminpanel&tab=questiondb");
      } elseif ($access == 2 Or 3) {
        //start user session
        $_SESSION['user'] = $username;
        //redirect to profile
        header("Location: index.php?page=profile");
      } else {
        // if else send user to profile page
        header("Location:index.php?page=profile");
      };
    } else {
      //if password verify fails, send to login page with alert
      header("Location:index.php?page=login&status=loginerror");
    }
    };
 ?>
