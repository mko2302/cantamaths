<?php
// Select the values required for past paper
$select = "SELECT DISTINCT question.yearID, year.yearname, question.levelID, level.levelname FROM question INNER JOIN year ON question.yearID = year.yearID INNER JOIN level ON question.levelID = level.levelID";

$order = "ORDER BY question.yearID DESC, question.levelID ASC";
// Complete SQL query that is filtered by the selected filters
$past_papers_sql = "$select WHERE question.yearID $yearsql and question.levelID $levelsql $order";
$past_papers_qry = mysqli_query($dbconnect, $past_papers_sql);
if (mysqli_num_rows($past_papers_qry)==0) {
// If there are no results display this message
  echo "<span class='p-1'>No results found</span>";
} else {
  $past_papers_aa = mysqli_fetch_assoc($past_papers_qry);

// Filler variables so that the AJAX function can be universal between custom and past papers
$QquestionID = "filler";

  do {
// Information that is drawn out of query
    $yearname = $past_papers_aa['yearname'];
    $yearID = $past_papers_aa['yearID'];
    $levelname = $past_papers_aa['levelname'];
    $levelID = $past_papers_aa['levelID'];

// Include code to display the past papers on page
    include("select-display-grid.php");
  } while ($past_papers_aa = mysqli_fetch_assoc($past_papers_qry));
} ?>
