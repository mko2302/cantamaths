<?php include("dbconnect.php");
// Set Output variable as Empty
// An variable must be used to output the data in order to make it compatible with TCPDF
$output = '';

// Split page into relevant SQL queries
if ($select_page == "custom") {
  include("print-display-custom-sql.php");
} elseif ($select_page == "pastpapers") {
  include("print-display-past-papers-sql.php");
}

$question_qry = mysqli_query($dbconnect, $question_sql);
$question_aa = mysqli_fetch_assoc($question_qry);

// Do loop for worksheet
if ($print_type == "worksheet") {
// Sete question number
  $Qnumber = 0;
  do {
// Add 1 each loop to question number
    $Qnumber++;
    $filename = $question_aa['filename'];
// Adding the table to output
    $output .= '
      <tr nobr="true">
        <td width="12.5%"></td>
        <td width="57.5%"><span style="font-size: 1.17em; font-weight: 500; text-decoration: underline;">Question'.$Qnumber.'</span><br><img src="questions/'.$filename.'" class="img-fluid"></td>
        <td width="30%"><h3 style="font-weight: 500; text-decoration: underline;">Answer</h3></td>
      </tr>';
  } while ($question_aa = mysqli_fetch_assoc($question_qry));
// Competition do loop
} elseif ($print_type == "competition") {
  $Qnumber = 0;
  do {
    $Qnumber++;
// Loop through each question the number of times there are teams
// Each time changing the letter
    for ($i=0, $letter="A"; $i < $teams; $i++, ++$letter) {
      $filename = $question_aa['filename'];

      $output .= '
        <tr nobr="true">
          <td width="12.5%"><h1>'.$letter.'</h1></td>
          <td width="57.5%"><span style="font-size: 1.17em; font-weight: 500; text-decoration: underline;">Question'.$Qnumber.'</span><br><img src="questions/'.$filename.'" class="img-fluid"></td>
          <td width="30%"><h3 style="font-weight: 500; text-decoration: underline;">Answer</h3></td>
        </tr>';
    }
  } while ($question_aa = mysqli_fetch_assoc($question_qry));
}
// Do loop for answer
elseif ($print_type == "answers") {
  $Qnumber = 0;
  do {
    $Qnumber++;
// Display the question number and answer along with columns for teams
    $answer = $question_aa['answer'];
    $output .= '
    <tr nobr="true">
      <td width="10%"><span style="font-size: 1.5em;">Q'.$Qnumber.'</span></td>
      <td width="30%"><span style="font-size: 1.5em;">'.$answer.'</span></td>
      <td width="6%"></td>
      <td width="6%"></td>
      <td width="6%"></td>
      <td width="6%"></td>
      <td width="6%"></td>
      <td width="6%"></td>
      <td width="6%"></td>
      <td width="6%"></td>
      <td width="6%"></td>
      <td width="6%"></td>
    </tr>
    ';
  } while ($question_aa = mysqli_fetch_assoc($question_qry));
} ?>
