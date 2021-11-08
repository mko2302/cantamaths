<?php $Q_ID = implode("','",$_SESSION['Q_ID']);
$Q_ID_SQL = "IN ('".$Q_ID."')";

$question_sql = "SELECT filename, answer FROM question WHERE questionID $Q_ID_SQL ORDER BY question.yearID DESC, question.levelID ASC, question.qnumber ASC"; ?>
