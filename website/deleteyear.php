<?php
  if (isset($_GET['yearID'])) {
    $yearID = $_GET['yearID'];
  } else {
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=error");
  }
  $delete_year_sql = "DELETE FROM year where yearID = $yearID";

  if ($delete_year_qry = mysqli_query($dbconnect, $delete_year_sql)) {
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=yeardeleted");
  }

 ?>
