<?php session_start();
include("dbconnect.php");

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
  $alex = count($_SESSION['Q_ID']); ?>

  <div class="py-2">
    <div class="py-1 px-2 border-header">
      <p style="margin: 0px; font-weight: 500;">Selected: <?php echo $alex; ?></p>
    </div>
  </div>


  <div class="pt-1 pb-2">
    <button type="button" style="font-weight: 500; font-size: 15px; margin: 0px; padding: 0px;" class="btn btn-danger btn-block p-1" onclick="send_selected('clear')" id="Clear_Selected">Unselect All</button>
  </div>


  <?php $Q_ID = implode("','",$_SESSION['Q_ID']);
  $Q_ID_SQL = "IN ('".$Q_ID."')";



  $selected_sql = "SELECT * FROM question INNER JOIN year ON question.yearid = year.yearID INNER JOIN level ON question.levelID = level.levelID WHERE questionID $Q_ID_SQL ORDER BY question.yearID DESC, question.levelID ASC, question.qnumber ASC";
  $selected_qry = mysqli_query($dbconnect, $selected_sql);
  $selected_aa = mysqli_fetch_assoc($selected_qry); ?>


  <div class=''>
    <?php do {
      echo "<div class='mb-2 container-fluid border-sub' style='margin: 0px; border: 0px;'>";
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

          echo "<div class='col-4 text-center' style='padding: 0px;'>";
            echo nl2br("Question $qnumber \n");
            echo nl2br("$yearname \n");
            echo nl2br("$levelname \n");
          echo "</div>";

          echo "<div class='col-8' style='padding: 0px;'>";
    # displays the image with the filename
            echo "<img src='questions/$filename' class='img-fluid'>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
  # Repeats until all questions have been displayed
    } while ($selected_aa = mysqli_fetch_assoc($selected_qry));
  echo "</div>";
  echo "<div class='pt-1 pb-2'>";
    echo "<a style='font-weight: 500; font-size: 15px; margin: 0px; padding: 0px;' class='btn btn-block btn-danger p-1' href='custom-print.php?' role='button'>Next</a>";
  echo "</div>";
} else { ?>
  <div class="py-2">
    <div class="py-1 px-2 border-header">
      <p style="margin: 0px; font-weight: 500;">Selected: 0</p>
    </div>
  </div>
  <div class="pt-1 pb-2">
    <a style="font-weight: 500; font-size: 15px; margin: 0px; padding: 0px;" class="btn btn-block btn-danger p-1 disabled" href="custom-print.php?" role="button">Next</a>
  </div>
<?php } ?>
