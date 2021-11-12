<?php include("dbconnect.php");


if (isset($_SESSION['Q_ID'])) {
// If there are selected question then let the Next button be clickable
  $Next_disabled = "false";

// Lets the selected questionIDs be used in the SQL query
  $Q_ID = implode("','",$_SESSION['Q_ID']);
  $Q_ID_SQL = "IN ('".$Q_ID."')";

// SQL query to return all selected questions
  $question_sql = "SELECT * FROM question INNER JOIN year ON question.yearid = year.yearID INNER JOIN level ON question.levelID = level.levelID WHERE questionID $Q_ID_SQL ORDER BY question.yearID DESC, question.levelID ASC, question.qnumber ASC";
  $question_qry = mysqli_query($dbconnect, $question_sql);
  $question_aa = mysqli_fetch_assoc($question_qry);

  do{
// include the code to get data from the loop
    include("display-question-loop.php");
// Include code to Display the selected questions on the page
    include("select-selected-grid.php");
  } while ($question_aa = mysqli_fetch_assoc($question_qry));
} else {
// If there are no selected question then let the Next Button be disabled
  $Next_disabled = "true";
}?>
