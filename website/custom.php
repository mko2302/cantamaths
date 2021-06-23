<?php

if(!isset($_GET['filter'])) {
  $filter = "year";
} else {
$filter = $_GET['filter'];
}

include("filter.php");
echo "$filter";

$question_sql = "SELECT * FROM question ORDER BY $filter ASC, qnumber ASC";
$question_qry = mysqli_query($dbconnect, $question_sql);
$question_aa = mysqli_fetch_assoc($question_qry);

do {
  $filename = $question_aa['filename'];
  $answer = $question_aa['answer'];
  $level = $question_aa['level'];
  $year = $question_aa['year'];
  $questionID = $question_aa['questionID'];

  echo "$filename";
  echo "<div class='col-5'>";
        echo "<img src='question/$filename' class='img-fluid'>";

  echo "</div>";
} while ($question_aa = mysqli_fetch_assoc($question_qry));

?>
