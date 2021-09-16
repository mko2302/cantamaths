<?php
  if (isset($_GET['tagID'])) {
    $tagID = $_GET['tagID'];
  } else {
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=tagerror");
  }
  $delete_tag_sql = "DELETE FROM tag where tagID = $tagID";

  if ($delete_tag_qry = mysqli_query($dbconnect, $delete_tag_sql)) {
    header("Location:index.php?page=adminpanel&tab=dbsettings&status=tagdeleted");
  }

 ?>
