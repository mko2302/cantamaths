<?php
  $questionID = $_GET['questionID'];
  $qnumber = $_POST['qnumber'];
  $answer = $_POST['answer'];
  $year = $_POST['year'];
  $level = $_POST['level'];
  // error catching if no tags are entered
  if (isset($_POST['tag'])) {
    $tags = $_POST['tag'];
  }
  // check if any questions in database are the same
  $check_sql = "SELECT * FROM question WHERE qnumber LIKE $qnumber AND yearID LIKE '$year' AND levelID LIKE $level AND answer LIKE $answer";

  $check_qry = mysqli_query($dbconnect, $check_sql);

  // CHECK if user changed any tags
  // foreach ($tags as $tag) {
  //   $tag_check_sql = "SELECT * FROM questiontag WHERE questionID = $questionID AND $tagID LIKE $tag";
  //   $tag_check_qry = mysqli_query($dbconnect, $check_sql);
  //   $tag_check_aa = mysqli_fetch_assoc($tag_check_qry);
  //
  //   do {
  //     $tagID_check = $tag_check_aa['tagID'];
  //     if ($tagID_check = $tag) {
  //
  //     }
  //   } while $tag_check_aa = mysqli_fetch_assoc($tag_check_qry
  //
  // }

  clearstatcache();

  if ((mysqli_num_rows($check_qry) > 0)){
    header("Location:index.php?page=adminpanel&tab=questiondb&status=duplicateq");
  } else {
    //deletes previous tags
    $delete_tag_sql = "DELETE FROM questiontag WHERE questionID=$questionID";
    // sends sql query to data base
    $delete_tag_qry = mysqli_query($dbconnect, $delete_tag_sql);

    //adds new array of tags
    if (isset($_POST['tag'])) {
      foreach ($tags as $tagID){
        $addtag_sql = "INSERT INTO questiontag (questionID, tagID) VALUES ($questionID, $tagID)";

        $addtag_qry = mysqli_query($dbconnect, $addtag_sql);
      }
    }

    $update_sql = "UPDATE question
                   SET qnumber = $qnumber, answer = $answer, levelID = $level, yearID = $year
                   WHERE questionID = $questionID";

    $update_qry = mysqli_query($dbconnect, $update_sql);

    $questiontag_sql = "SELECT * FROM questiontag WHERE questionID = $questionID";
    $questiontag_qry = mysqli_query($dbconnect, $questiontag_sql);
    $questiontag_aa = mysqli_fetch_assoc($questiontag_qry);

  }

 ?>
