<?php
 session_start();

 include("userinfo.php");



// if the users account is activated by admin
 if ($_SESSION['active']) {
   echo "<p>Username: ";
   echo $_SESSION['active'];
   echo "</p>";
   echo "<p>Status: Account Active</p>";
 } elseif ($_SESSION['inactive']) {
   // if users account is not activated
   echo "<p>Username: ";
   echo $_SESSION['inactive'];
   echo "</p>";
   echo"<p>Status Account Inactive<p>";
 }

 ?>

<a class="nav-link" href="logout.php">Log Out</a>
