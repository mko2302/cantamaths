<?php session_start();

# Checks if filters are set and if so clears the sessions they are in
# level filters
if(isset($_SESSION['levelID'])) {
  unset($_SESSION['levelID']);
}
# year filters
if(isset($_SESSION['yearID'])) {
  unset($_SESSION['yearID']);
} ?>
