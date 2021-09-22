<?php $yearID = implode($_SESSION['selected-yearID']);
$levelID = implode($_SESSION['selected-levelID']);

$question_sql = "SELECT filename, answer FROM question WHERE yearID = $yearID and levelID = $levelID";
$question_qry = mysqli_query($dbconnect, $question_sql);
$question_aa = mysqli_fetch_assoc($question_qry);



  do {
     $filename = $question_aa['filename']; ?>

     <tr>
       <td style="width: 10%;"></td>
       <?php echo "<td><img src='questions/$filename' class='img-fluid'></td>" ?>
     </tr>

   <?php } while ($question_aa = mysqli_fetch_assoc($question_qry));
