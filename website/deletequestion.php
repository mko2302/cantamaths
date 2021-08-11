<?php
  if (isset($_GET['questionID'])) {
    $questionID = $_GET['questionID'];

    // gets filename
    $filename_sql = "SELECT * FROM question WHERE questionID=$questionID";
    $filename_qry = mysqli_query($dbconnect, $filename_sql);
    $filename_aa = mysqli_fetch_assoc($filename_qry);
    $filename = $filename_aa['filename'];

    $file_path = "questions/$filename";

    //deletes file from server
    if (file_exists($file_path)) {
      if (unlink($file_path)) {
      }
    }

    $delete_sql = "DELETE FROM question WHERE questionID=$questionID";

    // sends sql query to data base
    $delete_qry = mysqli_query($dbconnect, $delete_sql);

    $delete_tag_sql = "DELETE FROM questiontag WHERE questionID=$questionID";
    // sends sql query to data base
    $delete_tag_qry = mysqli_query($dbconnect, $delete_tag_sql);

    header("Location: index.php?page=adminpanel&tab=questiondb&status=deletesuccess");
  } else {
    header("Location: index.php?page=adminpanel&tab=questiondb&status=error");
  }

 ?>
