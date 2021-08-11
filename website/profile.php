<?php
 include("userinfo.php");


 if ($access == 1) {
   $_SESSION['access'] = 'active';
   echo "Active User";
 } elseif ($access == 0) {
   $_SESSION['access'] = 'inactive';
   echo "Inactive User";
 }



 ?>

<a class="nav-link" href="logout.php">Log Out</a>
