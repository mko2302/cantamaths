<?php include("filter-to-in.php");

if (isset($_SESSION['tagID'])) {
  unset($_SESSION['questionID']);
  $_SESSION['questionID'] = [];


  $tag = implode("','",$_SESSION['tagID']);
  $tagsql = "IN ('".$tag."')";

  $tag_sql = "SELECT * FROM questiontag WHERE tagID $tagsql";
  $tag_qry = mysqli_query($dbconnect, $tag_sql);
  if (mysqli_num_rows($tag_qry)==0) {
  } else {
      $tag_aa = mysqli_fetch_assoc($tag_qry);
    }
  do {
    $SquestionID = $tag_aa['questionID'];
    if (in_array($SquestionID,$_SESSION['questionID'])) {
    } else {
      array_push($_SESSION['questionID'],$SquestionID);
    }
  } while ($tag_aa = mysqli_fetch_assoc($tag_qry));

  $questionID = implode("','",$_SESSION['questionID']);
  $questionIDsql = "IN ('".$questionID."')";
} else {
  $questionIDsql = "";
} ?>


<div class="py-2">
  <div class="py-1 px-2 border-header">
    <p style="margin: 0px; font-weight: 500;">Results to of</p>
  </div>
</div>


<?php $select = "SELECT question.questionID, question.filename, question.answer, question.yearID, year.yearname, question.levelID, level.levelname, question.qnumber FROM question
                INNER JOIN year ON question.yearid = year.yearID
                INNER JOIN level ON question.levelID = level.levelID";

$order = "ORDER BY question.yearID DESC, question.levelID ASC, question.qnumber ASC";

# Selects all from table question where each column is the same as the filters
# If the variable set above is blank then it will select all from that column otherwise only selects those that where in the array
$question_sql = "$select WHERE question.yearID $yearsql and question.levelID $levelsql and question.questionID $questionIDsql $order";
$question_qry = mysqli_query($dbconnect, $question_sql);
if (mysqli_num_rows($question_qry)==0) {
} else {
  $question_aa = mysqli_fetch_assoc($question_qry);



  echo "<div class='container-fluid row pt-1' style='margin: 0px; padding: 0px;'>";
# Runs through and displays all questions that condcide with the selected filters
    $a = 0;
    do {
      $qnumber = $question_aa['qnumber'];
      $yearname = $question_aa['yearname'];
      $levelname = $question_aa['levelname'];
      $filename = $question_aa['filename'];
      $QquestionID = $question_aa['questionID'];

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
      } ?>



      <div id="div_Qclick <?php echo "$QquestionID"; ?>" class='col-6 border-sub mb-2' style="padding: 0px;">
        <input type="checkbox" style='display:none;' id="Qclick <?php echo "$QquestionID"; ?>" onclick="send_selected(<?php echo "'$QquestionID'"; ?>), highlight_selected(<?php echo "'$QquestionID'"; ?>)">
        <label class="container-fluid" style="margin: 0px;" for='Qclick <?php echo "$QquestionID"; ?>'>
          <div class='row'>
            <?php echo "<div style='padding: 0px; line-height: 1.4; top: 50%;' class='col-4 text-center'>";
              echo nl2br("Question $qnumber \n");
              echo nl2br("$yearname \n");
              echo nl2br("Year $levelname \n");
              echo "Tags";
            echo "</div>";

            echo "<div class='col-8' style='padding: 0px;'>";
# displays the image with the filename
              echo "<img src='questions/$filename' class='img-fluid'>";
            echo "</div>";
          echo "</div>";
        echo "</label>";
      echo "</div>";
# Repeats until all questions have been displayed
    } while ($question_aa = mysqli_fetch_assoc($question_qry));
  echo "</div>";
} ?>
