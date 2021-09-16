<?php $dbconnect = mysqli_connect("localhost", "root", "", "cantamathsdb");

if (isset($_GET['yearID'])) {
  $_SESSION['selected-levelID'] = [$_GET['levelID']];
  $_SESSION['selected-yearID'] = [$_GET['yearID']];
  $yearID = implode($_SESSION['selected-yearID']);
  $levelID = implode($_SESSION['selected-levelID']);


  $Next_disabled = "false";
  include("past-papers-selected-sql-inner.php");
} elseif (isset($_SESSION['selected-levelID'])) {
  $Next_disabled = "false";
  include("past-papers-selected-sql-inner.php");
} else {
  $Next_disabled = "true";
} ?>
