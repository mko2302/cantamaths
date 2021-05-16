<?php
$question_sql = "SELECT * FROM question";
$question_qry = mysqli_query($dbconnect, $question_sql);
$question_aa = mysqli_fetch_assoc($question_qry);

$filename = $question_aa['filename'];
$answer = $question_aa['answer'];
$level = $question_aa['level'];
$year = $question_aa['year'];
$questionID = $question_aa['questionID'];

echo "<img src='images/$filename'>";
?>
