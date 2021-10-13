<?php $yearID = implode($_SESSION['selected-yearID']);
$levelID = implode($_SESSION['selected-levelID']);

$question_sql = "SELECT filename, answer FROM question WHERE yearID = $yearID and levelID = $levelID"; ?>
