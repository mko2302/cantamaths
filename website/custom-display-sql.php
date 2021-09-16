<?php if (isset($_SESSION['tagID'])) {
  unset($_SESSION['questionID']);
  $_SESSION['questionID'] = [];


  $tag = implode("','",$_SESSION['tagID']);
  $tagsql = "IN ('".$tag."')";

  $tag_sql = "SELECT DISTINCT questionID FROM questiontag WHERE tagID $tagsql";
  $tag_qry = mysqli_query($dbconnect, $tag_sql);
  if (mysqli_num_rows($tag_qry)==0) {
  } else {
      $tag_aa = mysqli_fetch_assoc($tag_qry);
    }
  do {
    $SquestionID = $tag_aa['questionID'];
    if (in_array($SquestionID,$_SESSION['questionID'])) {
    } else {
      array_push($_SESSION['questionID'],$SquestionID);
    }
  } while ($tag_aa = mysqli_fetch_assoc($tag_qry));

  $questionID = implode("','",$_SESSION['questionID']);
  $questionIDsql = "IN ('".$questionID."')";
} else {
  $questionIDsql = "";
} ?>


<?php $select = "SELECT question.questionID, question.filename, question.answer, question.yearID, year.yearname, question.levelID, level.levelname, question.qnumber FROM question
                INNER JOIN year ON question.yearid = year.yearID
                INNER JOIN level ON question.levelID = level.levelID";

$order = "ORDER BY question.yearID DESC, question.levelID ASC, question.qnumber ASC";

# Selects all from table question where each column is the same as the filters
# If the variable set above is blank then it will select all from that column otherwise only selects those that where in the array
$question_sql = "$select WHERE question.yearID $yearsql and question.levelID $levelsql and question.questionID $questionIDsql $order";
$question_qry = mysqli_query($dbconnect, $question_sql);
$question_num_rows = mysqli_num_rows($question_qry);
if (mysqli_num_rows($question_qry)==0) {
  echo "no results";
} else {
  $question_aa = mysqli_fetch_assoc($question_qry);


  do {
    $qnumber = $question_aa['qnumber'];
    $yearname = $question_aa['yearname'];
    $levelname = $question_aa['levelname'];
    $filename = $question_aa['filename'];
    $QquestionID = $question_aa['questionID'];
    $_SESSION["Tags'".$QquestionID."'"] = [];


    $questionID_sql = "SELECT DISTINCT tagname FROM questiontag INNER JOIN tag ON questiontag.tagID = tag.tagID WHERE questionID = $QquestionID";
    $questionID_qry = mysqli_query($dbconnect, $questionID_sql);
    if (mysqli_num_rows($questionID_qry)==0) {
    } else {
      $questionID_aa = mysqli_fetch_assoc($questionID_qry);


      do {
        $tagname = $questionID_aa['tagname'];
        array_push($_SESSION["Tags'".$QquestionID."'"],$tagname);
      } while ($questionID_aa = mysqli_fetch_assoc($questionID_qry));
    }


    include("select-display-grid.php");
  } while ($question_aa = mysqli_fetch_assoc($question_qry));
} ?>
