<?php
  // if year is set
  if (isset($_GET['yearID'])) {
    // define variable
    $yearID = $_GET['yearID'];
  } else {
    // if not send user back with error
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=error");
  }
  // delete question sql query
  $delete_year_sql = "DELETE FROM year where yearID = $yearID";

  // if the query is sent
  if ($delete_year_qry = mysqli_query($dbconnect, $delete_year_sql)) {
    // send user back with alert
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=yeardeleted");
  } else {
    // if not work send user with error message
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=error");
  }

 ?>
