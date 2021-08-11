<?php session_start();
$dbconnect = mysqli_connect("localhost", "root", "", "cantamathsdb");

$array = 'Q_ID';
$id = $_GET['questionID'];


if( $id == 'clear' ) {
  if(isset($_SESSION['Q_ID'])) {
     unset($_SESSION['Q_ID']);
  }
} else {
  include('session.php');
}


if (isset($_SESSION['Q_ID'])) {
  echo "<button class=btn onclick=send_selected('clear')>Unselect All</button>";
  $Q_ID = implode("','",$_SESSION['Q_ID']);
  $Q_ID_SQL = "IN ('".$Q_ID."')";


  $selected_sql = "SELECT * FROM question INNER JOIN year ON question.yearid = year.yearID INNER JOIN level ON question.levelID = level.levelID WHERE questionID $Q_ID_SQL";
  $selected_qry = mysqli_query($dbconnect, $selected_sql);
  $selected_aa = mysqli_fetch_assoc($selected_qry); ?>

  <?php
  # Runs through and displays all questions that condcide with the selected filters
    do {
      echo "<div class='row'>";
      $qnumber = $selected_aa['qnumber'];
      $yearname = $selected_aa['yearname'];
      $levelname = $selected_aa['levelname'];
      $filename = $selected_aa['filename'];
      $QquestionID = $selected_aa['questionID'];

      $_SESSION["Tags'".$QquestionID."'"] = [];

      $questionID_sql = "SELECT DISTINCT tagname FROM questiontag INNER JOIN tag ON questiontag.tagID = tag.tagID WHERE questionID = $QquestionID";
      $questionID_qry = mysqli_query($dbconnect, $questionID_sql);
      $questionID_aa = mysqli_fetch_assoc($questionID_qry);

      if (!$questionID_aa) {
      } else {
        do {
          $tagname = $questionID_aa['tagname'];
          array_push($_SESSION["Tags'".$QquestionID."'"],$tagname);
        } while ($questionID_aa = mysqli_fetch_assoc($questionID_qry));
      }

      echo "<div class='col-4 text-center'>";
        echo nl2br("Question $qnumber \n");
        echo nl2br("$yearname \n");
        echo nl2br("$levelname \n");
      echo "</div>";

      echo "<div class='col-8'>";
  # displays the image with the filename
        echo "<img src='question/$filename' class='img-fluid'>";
      echo "</div>";
      echo "</div>";
    echo "</label>";
  echo "</div>";
  # Repeats until all questions have been displayed
  } while ($selected_aa = mysqli_fetch_assoc($selected_qry));
  echo "</div>";
    echo "<a href='index.php?page=print' class='btn' role='button'>Print</a>";
} else {
} ?>
