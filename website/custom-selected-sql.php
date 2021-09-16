<?php $dbconnect = mysqli_connect("localhost", "root", "", "cantamathsdb");


$array = 'Q_ID';
if (isset($_GET['questionID'])) {
  $id = $_GET['questionID'];

  if( $id == 'clear' ) {
    if(isset($_SESSION['Q_ID'])) {
      unset($_SESSION['Q_ID']);
    }
  } else {
    include('session.php');
  }
}


if (isset($_SESSION['Q_ID'])) {
  $Next_disabled = "false";
  $alex = count($_SESSION['Q_ID']); ?>
  <button type="button" class="btn btn-danger btn-block p-1 m-1 font-boldish" onclick="send_selected('clear', 'filler', 'filler'), send_filters('filler', 'refresh')">Unselect All</button>


  <?php $Q_ID = implode("','",$_SESSION['Q_ID']);
  $Q_ID_SQL = "IN ('".$Q_ID."')";


  $question_sql = "SELECT * FROM question INNER JOIN year ON question.yearid = year.yearID INNER JOIN level ON question.levelID = level.levelID WHERE questionID $Q_ID_SQL ORDER BY question.yearID DESC, question.levelID ASC, question.qnumber ASC";
  $question_qry = mysqli_query($dbconnect, $question_sql);
  $question_aa = mysqli_fetch_assoc($question_qry);

  do{
    include("display-question-loop.php");

    include("select-selected-grid.php");
  } while ($question_aa = mysqli_fetch_assoc($question_qry));
} else {
  $Next_disabled = "true";
}?>
