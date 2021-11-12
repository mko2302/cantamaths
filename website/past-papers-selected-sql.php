<?php include("dbconnect.php");
// Checking if question had been Selected
// If so then then set the variables as sessions so they can then be grabbed from the print page
if (isset($_GET['yearID'])) {
  $_SESSION['selected-levelID'] = [$_GET['levelID']];
  $_SESSION['selected-yearID'] = [$_GET['yearID']];
// imploding the Session so that they are compatible with SQL query
  $yearID = implode($_SESSION['selected-yearID']);
  $levelID = implode($_SESSION['selected-levelID']);

  // let the Next button be clickable
  $Next_disabled = "false";
  include("past-papers-selected-sql-inner.php");
} elseif (isset($_SESSION['selected-levelID'])) {
// If the page is being reloaded but not through the AJAX function (already a past paper selected)
  $Next_disabled = "false";
  include("past-papers-selected-sql-inner.php");
} else {
// If not selected past paper let Next button be disabled
  $Next_disabled = "true";
} ?>
