<?php
  session_start();

  unset($_SESSION['admin']);
  unset($_SESSION['user']);
  // sends user back to home page
  header("Location:index.php");

 ?>
