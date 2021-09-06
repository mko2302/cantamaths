<?php $dbconnect = mysqli_connect("localhost", "root", "", "cantamathsdb");

$yearID = $_GET['yearID'];
$levelID = $_GET['levelID'];


$select = "SELECT question.questionID, question.filename, question.answer, question.yearID, year.yearname, question.levelID, level.levelname, question.qnumber FROM question
                INNER JOIN year ON question.yearid = year.yearID
                INNER JOIN level ON question.levelID = level.levelID";

# Selects all from table question where each column is the same as the filters
# If the variable set above is blank then it will select all from that column otherwise only selects those that where in the array
$selected_sql = "$select WHERE question.yearID = $yearID and question.levelID = $levelID";
$selected_qry = mysqli_query($dbconnect, $selected_sql);
$selected_aa = mysqli_fetch_assoc($selected_qry);

$yearname = $selected_aa['yearname'];
$levelname = $selected_aa['levelname']; ?>

<div class="py-2">
  <div class="py-1 px-2 border-header">
    <p style="margin: 0px; font-weight: 500;">Selected: <?php echo $yearname, " year ", $levelname, " exam"; ?></p>
  </div>
</div>

<div class='pt-1'>
  <?php do {
    echo "<div class='mb-2 container-fluid row border-sub' style='margin: 0px; border: 0px;'>";

      $qnumber = $selected_aa['qnumber'];
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
        echo "<img src='questions/$filename' class='img-fluid'>";
      echo "</div>";
    echo "</div>";

# Repeats until all questions have been displayed
  } while ($selected_aa = mysqli_fetch_assoc($selected_qry));
echo "</div>"; ?>


<div class="pt-1 pb-2">
  <?php echo "<a style='font-size: 15px; font-weight: 500; margin: 0px; padding: 0px;' class='btn btn-block btn-danger p-1' href='past-paper-print.php?yearID=$yearID&levelID=$levelID' role='button'>Next</a>"; ?>
</div>
