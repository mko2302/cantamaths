<?php $Q_ID = implode("','",$_SESSION['Q_ID']);
$Q_ID_SQL = "IN ('".$Q_ID."')";

$question_sql = "SELECT filename, answer FROM question WHERE questionID $Q_ID_SQL ORDER BY question.yearID DESC, question.levelID ASC, question.qnumber ASC";
$question_qry = mysqli_query($dbconnect, $question_sql);
$question_aa = mysqli_fetch_assoc($question_qry);

if ($print_type == "worksheet") {
  do {
    $filename = $question_aa['filename']; ?>

    <tr>
      <td style="width: 10%;"></td>
      <?php echo "<td><img src='questions/$filename' class='img-fluid'></td>" ?>
    </tr>

  <?php } while ($question_aa = mysqli_fetch_assoc($question_qry));
} ?>
