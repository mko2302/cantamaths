<?php if (isset($_SESSION['yearID'])) {
# If the filters for year is set then create implode the array and create a variable that contains all filters that can be run through sql
  $year = implode("','",$_SESSION['yearID']);
  $yearsql = "IN ('".$year."')";
} else {
# Otherwise set that variable as blank
  $yearsql = "";
}

# Same as above but with level
if (isset($_SESSION['levelID'])) {
  $level = implode("','",$_SESSION['levelID']);
  $levelsql = "IN ('".$level."')";
} else {
  $levelsql = "";
} ?>
