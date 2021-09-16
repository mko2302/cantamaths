<?php session_start();
include("dbconnect.php");

$id = $_GET['id'];
$array = $_GET['filter'];
$select_page = $_GET['select_page'];

if ($id == 'clear') {
  if(isset($_SESSION['levelID'])) {
    unset($_SESSION['levelID']);
  }
  if(isset($_SESSION['yearID'])) {
    unset($_SESSION['yearID']);
  }
  if(isset($_SESSION['tagID'])) {
     unset($_SESSION['tagID']);
  }
} elseif ($id == 'all') {
  if(isset($_SESSION[$array])) {
    unset($_SESSION[$array]);
  }
} else {
  include('session.php');
}

include("select-display.php"); ?>
