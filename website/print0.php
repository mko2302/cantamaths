<?php session_start();

$dbconnect = mysqli_connect("localhost", "root", "", "cantamathdb");

$levelID = $_GET['levelID'];
$yearID = $_GET['yearID'];


$a = 0;
do {
  if ($a == 0) {
    $number = $levelID;
    $filter = 'levelID';
  } else {
    $number = $yearID;
    $filter = 'yearID';
  }


  if (isset($_SESSION[$filter])) {
    if (in_array($number,$_SESSION[$filter])) {
      if (($key = array_search($number, $_SESSION[$filter])) !== FALSE) {
        unset($_SESSION[$filter][$key]);
      }
    } else {
      array_push($_SESSION[$filter],$number);
    }
  } else {
  $_SESSION[$filter] = [$number];
  }


  if ($a == 0) {
    $level = implode("','",$_SESSION[$filter]);
  } else {
    $year = implode("','",$_SESSION[$filter]);
  }


  $a += 1;
} while ($a <= 1);


if(!isset($levelID)) {
  if(!isset($yearID)) {
    $var = "SELECT * FROM question";
  } else {
    $var = "SELECT * FROM question WHERE yearID IN ('".$year."')";
  }
} else {
  if(!isset($yearID)) {
    $var = "SELECT * FROM question WHERE levelID IN ('".$level."')";
  } else {
    $var = "SELECT * FROM question WHERE levelID IN ('".$level."') and yearID IN ('".$year."')";
  }
}

echo $var;
echo "level:", $level;
echo "year:", $year;


$question_sql = $var;
$question_qry = mysqli_query($dbconnect, $question_sql);
$question_aa = mysqli_fetch_assoc($question_qry);

do {
  $filename = $question_aa['filename'];


  echo "<img src='question/$filename' class='img-fluid'>";
} while ($question_aa = mysqli_fetch_assoc($question_qry)); ?>
