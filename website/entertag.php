<?php
  $tag_name = $_POST['tag_name'];

  $check_qry = "SELECT * FROM tag WHERE tagname LIKE '$tag_name'";

  $check_sql = mysqli_query($dbconnect, $check_qry);
  if (mysqli_num_rows($check_sql) == 0) {
    // enter tags into Database
    $insert_sql = "INSERT INTO tag (tagname) VALUES ('$tag_name')";
    // sends sql query to data base
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    header("index.php?page=adminpanel&tab=dbsettings&status=tagsuccess");
  } else {
    header("index.php?page=adminpanel&tab=dbsettings&status=duplicatetag");
  }



 ?>
