<?php
// Get all data from query
$qnumber = $question_aa['qnumber'];
$yearname = $question_aa['yearname'];
$levelname = $question_aa['levelname'];
$filename = $question_aa['filename'];
$QquestionID = $question_aa['questionID'];
$_SESSION["Tags'".$QquestionID."'"] = [];

// Get all Tags that correspond with the current question
$questionID_sql = "SELECT DISTINCT tagname FROM questiontag INNER JOIN tag ON questiontag.tagID = tag.tagID WHERE questionID = $QquestionID";
$questionID_qry = mysqli_query($dbconnect, $questionID_sql);
if (mysqli_num_rows($questionID_qry)==0) {
} else {
  $questionID_aa = mysqli_fetch_assoc($questionID_qry);

// Add tags to a Session
  do {
    $tagname = $questionID_aa['tagname'];
    array_push($_SESSION["Tags'".$QquestionID."'"],$tagname);
  } while ($questionID_aa = mysqli_fetch_assoc($questionID_qry));
} ?>
