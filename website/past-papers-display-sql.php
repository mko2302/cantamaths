<?php $select = "SELECT DISTINCT question.yearID, year.yearname, question.levelID, level.levelname FROM question INNER JOIN year ON question.yearID = year.yearID INNER JOIN level ON question.levelID = level.levelID";

$order = "ORDER BY question.yearID DESC, question.levelID ASC";

$past_papers_sql = "$select WHERE question.yearID $yearsql and question.levelID $levelsql $order";
$past_papers_qry = mysqli_query($dbconnect, $past_papers_sql);
if (mysqli_num_rows($past_papers_qry)==0) {
} else {
  $past_papers_aa = mysqli_fetch_assoc($past_papers_qry);


$QquestionID = "filler";

  do {
    $yearname = $past_papers_aa['yearname'];
    $yearID = $past_papers_aa['yearID'];
    $levelname = $past_papers_aa['levelname'];
    $levelID = $past_papers_aa['levelID'];


    include("select-display-grid.php");
  } while ($past_papers_aa = mysqli_fetch_assoc($past_papers_qry));
} ?>
