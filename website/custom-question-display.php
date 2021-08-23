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
}


$results_per_page = 10;

//find number of pages needed to display all questions
$number_of_pages = ceil("60"/$results_per_page);

//find number page user is on
?>
<div id="pagination_id">
<?php $qpage = 1 ?>
</div>
<?php
echo $qpage;


$page_first_result = ($qpage - 1) * $results_per_page;


$select = "SELECT question.questionID, question.filename, question.answer, question.yearID, year.yearname, question.levelID, level.levelname, question.qnumber FROM question
                INNER JOIN year ON question.yearid = year.yearID
                INNER JOIN level ON question.levelID = level.levelID";

$order = "ORDER BY question.yearID DESC, question.levelID ASC, question.qnumber ASC";

# Selects all from table question where each column is the same as the filters
# If the variable set above is blank then it will select all from that column otherwise only selects those that where in the array
$question_sql = "$select WHERE question.yearID $yearsql and question.levelID $levelsql and question.questionID $questionIDsql $order LIMIT $page_first_result , $results_per_page";
$question_qry = mysqli_query($dbconnect, $question_sql);
if (mysqli_num_rows($question_qry)==0) {
} else {
  $question_aa = mysqli_fetch_assoc($question_qry);

echo "<div class='row'>";
# Runs through and displays all questions that condcide with the selected filters
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
    }?>


    <div class='border col-6'>
      <input type="checkbox" style='display:none;' id="Qclick <?php echo "$QquestionID"; ?>" onclick="send_selected(<?php echo "'$QquestionID'"; ?>)">
      <label for='Qclick <?php echo "$QquestionID"; ?>'>
      <div class='row'>
<?php # Gets the filename of the image for the question
        echo "<div style='font-size: 13px;' class='col-4 text-center'>";
          echo nl2br("Question $qnumber \n");
          echo nl2br("$yearname \n");
          echo nl2br("Year $levelname \n");
        echo "</div>";

        echo "<div class='col-8'>";
# displays the image with the filename
          echo "<img src='questions/$filename' class='img-fluid'>";
        echo "</div>";
        echo "</div>";
      echo "</label>";
    echo "</div>";
# Repeats until all questions have been displayed
  } while ($question_aa = mysqli_fetch_assoc($question_qry));
echo "</div>";
}
?>

<!-- pagination boostrap adapted from https://www.positronx.io/create-pagination-in-php-with-mysql-and-bootstrap/ -->
<nav aria-label="Page navigation mt-5">
    <ul class="pagination justify-content-center">
        <!-- previous button -->
        <li class="page-item <?php if($qpage <= 1){ echo 'disabled'; } ?>">
          <?php $prev = ($qpage - 1) ?>
            <a class="page-link"
                href="
            <?php
              if($qpage <= 1){
                echo '#';
              } else {
                echo "index.php?page=custom&tab=questiondb&qpage=$prev";
              } ?>
              ">Previous</a>
        </li>

        <!-- page number button -->
        <?php for($i = 1; $i <= $number_of_pages; $i++ ): ?>
        <li class="page-item <?php if($qpage == $i) {echo 'active'; } ?>">
            <a class="page-link" onclick="pagination(<?php echo "'$i'"; ?>)"> <?= $i; ?> </a>
        </li>
        <?php endfor; ?>

        <!-- next button -->
        <li class="page-item <?php if($qpage >= $number_of_pages) { echo 'disabled'; } ?>">
            <a class="page-link"
              <?php $next = ($qpage + 1) ?>
                href="
              <?php
                if($page >= $number_of_pages){
                  echo '#';
                } else {
                  echo "index.php?page=custom&tab=questiondb&qpage=$next";
                } ?>
                ">Next</a>
        </li>
    </ul>
</nav>
