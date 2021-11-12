<!-- Getting the question compatible with SQL query -->
<?php $yearID = implode($_SESSION['selected-yearID']);
$levelID = implode($_SESSION['selected-levelID']);
// Getting the filename and answer from selected past papers
$question_sql = "SELECT filename, answer FROM question WHERE yearID = $yearID and levelID = $levelID"; ?>
