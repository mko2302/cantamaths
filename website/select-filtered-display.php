<?php session_start();
include("dbconnect.php");
// Getting variables from AJAX function
$id = $_GET['id'];
$array = $_GET['filter'];
$select_page = $_GET['select_page'];
// If Unselect all questions has been clicked
if ($id == 'refresh') {
  if(isset($_SESSION['Q_ID'])) {
    unset($_SESSION['Q_ID']);
  }
// If Clear all filters has been clicked
} elseif ($id == 'clear') {
  if(isset($_SESSION['levelID'])) {
    unset($_SESSION['levelID']);
  }
  if(isset($_SESSION['yearID'])) {
    unset($_SESSION['yearID']);
  }
  if(isset($_SESSION['tagID'])) {
     unset($_SESSION['tagID']);
  }
// Unset filters if all has been checked
} elseif ($id == 'all') {
  if(isset($_SESSION[$array])) {
    unset($_SESSION[$array]);
  }
// Include code to update filter Sessions
} else {
  include('session.php');
}
// Then include code required to get and display questions
include("select-display.php"); ?>
