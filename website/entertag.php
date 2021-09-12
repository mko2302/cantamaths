<?php
  if (isset($_POST['tagname'])) {
    $tagname = $_POST['tagname'];
  } else {
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=tagerror");
  }

  $check_qry = "SELECT * FROM tag WHERE tagname LIKE '$tagname'";

  $check_sql = mysqli_query($dbconnect, $check_qry);
  if (mysqli_num_rows($check_sql) == 0) {
    // enter tags into Database
    $insert_sql = "INSERT INTO tag (tagname) VALUES ('$tagname')";
    // sends sql query to data base
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=tagsuccess");
  } else {
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=duplicatetag");
  }
?>
