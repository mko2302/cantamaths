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

  $check_sql = "SELECT * FROM question WHERE qnumber LIKE $qnumber AND yearID LIKE '$year' AND levelID LIKE $level AND answer LIKE $answer";

  $check_qry = mysqli_query($dbconnect, $check_sql);

  foreach ($tags as $tag) {
    $tag_check_sql = "SELECT * FROM questiontag WHERE questionID = $questionID AND $tagID LIKE $tag"
  }

  $check_tag_sql = "SELECT * FROM";

  // clearstatcache();
  //
  //   if (mysqli_num_rows($check_qry) > 0){
  //     header("Location:index.php?page=adminpanel&tab=questiondb&status=duplicateq");
  //   } else {
  //     // echo "$questionID $qnumber $answer $year $level ";
  //     foreach ($tags as $tag) {
  //       echo "$tag";
  //     }
  //
  //     $update_sql = "UPDATE question
  //                    SET qnumber = $qnumber, answer = $answer, levelID = $level, yearID = $year
  //                    WHERE questionID = $questionID";
  //
  //     $update_qry = mysqli_query($dbconnect, $update_sql);
  //
  //     $questiontag_sql = "SELECT * FROM questiontag WHERE questionID = $questionID";
  //     $questiontag_qry = mysqli_query($dbconnect, $questiontag_sql);
  //     $questiontag_aa = mysqli_fetch_assoc($question_qry);
  //
  //
  //   }

 ?>
