<?php
// Check if there are any selected tags
if (isset($_SESSION['tagID'])) {
  unset($_SESSION['questionID']);
  $_SESSION['questionID'] = [];

// Gets tags Session compatible with SQL quries
  $tag = implode("','",$_SESSION['tagID']);
  $tagsql = "IN ('".$tag."')";

// Runs query that returns all questionIDs that are under the given tags
  $tag_sql = "SELECT DISTINCT questionID FROM questiontag WHERE tagID $tagsql";
  $tag_qry = mysqli_query($dbconnect, $tag_sql);
  if (mysqli_num_rows($tag_qry)==0) {
// If returns no results make it so that the next query returns no values
    $questionIDsql = "= 9999";
  } else {
      $tag_aa = mysqli_fetch_assoc($tag_qry);
// Loop out the questionID and input into a Session
    do {
      $SquestionID = $tag_aa['questionID'];
      if (in_array($SquestionID,$_SESSION['questionID'])) {
      } else {
        array_push($_SESSION['questionID'],$SquestionID);
      }
    } while ($tag_aa = mysqli_fetch_assoc($tag_qry));
// Get questionID in a state that is compatible with an SQL query
    $questionID = implode("','",$_SESSION['questionID']);
    $questionIDsql = "IN ('".$questionID."')";
  }
} else {
  $questionIDsql = "";
} ?>


<!-- Inner join is used to get the filter names -->
<?php $select = "SELECT question.questionID, question.filename, question.answer, question.yearID, year.yearname, question.levelID, level.levelname, question.qnumber FROM question
                INNER JOIN year ON question.yearid = year.yearID
                INNER JOIN level ON question.levelID = level.levelID";
// Order the questions in the correct order
$order = "ORDER BY question.yearID DESC, question.levelID ASC, question.qnumber ASC";

# Selects all from table question where each column is the same as the filters
# If the variable set above is blank then it will select all from that column otherwise only selects those that where in the array
$question_sql = "$select WHERE question.yearID $yearsql and question.levelID $levelsql and question.questionID $questionIDsql $order";
$question_qry = mysqli_query($dbconnect, $question_sql);
$question_num_rows = mysqli_num_rows($question_qry);
if (mysqli_num_rows($question_qry)==0) {
// Error catching if no values are returned
  echo "<span class='px-1'>No results found</span>";
} else {
  $question_aa = mysqli_fetch_assoc($question_qry);

// Setting values as fillers so that the AJAX query is compatible with both past papers and custom
  $yearID = "filler";
  $levelID = "filler";


  do {
  // include the code to get data from the loop
    include("display-question-loop.php");
// Include code to Display the questions/past papers on the page
    include("select-display-grid.php");
  } while ($question_aa = mysqli_fetch_assoc($question_qry));
} ?>
