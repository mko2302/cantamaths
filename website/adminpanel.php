<!-- admin panel goes here -->

<?php
// check to see if logged in.
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
}

echo "<h2>Admin panel</h2>";

echo "<a href='index.php?page=addquestion'>Add Question</a>";

echo "<a class='nav-link' href='logout.php'>Log Out</a>"

 ?>
