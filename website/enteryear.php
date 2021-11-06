<?php
  if (isset($_POST['yearname'])) {
    $yearname = $_POST['yearname'];
  } else {
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=error");
  }

  $check_qry = "SELECT * FROM year WHERE yearname LIKE '$yearname'";

  $check_sql = mysqli_query($dbconnect, $check_qry);
  if (mysqli_num_rows($check_sql) == 0) {
    // enter years into Database
    $insert_sql = "INSERT INTO year (yearname) VALUES ('$yearname')";
    // sends sql query to data base
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=yearsuccess");
  } else {
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=duplicateyear");
  }
?>
