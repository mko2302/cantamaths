<?php $select = "SELECT question.questionID, question.filename, question.answer, question.yearID, year.yearname, question.levelID, level.levelname, question.qnumber FROM question
                INNER JOIN year ON question.yearid = year.yearID
                INNER JOIN level ON question.levelID = level.levelID";

# Selects all from table question where each column is the same as the filters
# If the variable set above is blank then it will select all from that column otherwise only selects those that where in the array
$question_sql = "$select WHERE question.yearID = $yearID and question.levelID = $levelID";
$question_qry = mysqli_query($dbconnect, $question_sql);
$question_aa = mysqli_fetch_assoc($question_qry);

$yearname = $question_aa['yearname'];
$levelname = $question_aa['levelname'];
do {
  include("display-question-loop.php");

  include("select-selected-grid.php");
} while ($question_aa = mysqli_fetch_assoc($question_qry)); ?>
