<!-- admin panel goes here -->

<?php
// check to see if logged in.
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
}

echo "Admin panel";

 ?>
