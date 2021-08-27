<?php include("filter-to-in.php");
# Selects all from table question where each column is the same as the filters
# If the variable set above is blank then it will select all from that column otherwise only selects those that where in the array
$year_sql = "SELECT DISTINCT question.yearID, year.yearname FROM question INNER JOIN year ON question.yearID = year.yearID WHERE question.yearID $yearsql";
$year_qry = mysqli_query($dbconnect, $year_sql);
if (mysqli_num_rows($year_qry)==0) {
} else {
  $year_aa = mysqli_fetch_assoc($year_qry);

  ?>
  <div class="py-2">
    <div class="p-1 border border-dark">
  <h6>Results to of</h6>
  </div>
    </div>

   <?php


echo "<div class='container-fluid row pt-1 pb-2' style='margin: 0px; padding: 0px;'>";
# Runs through and displays all questions that condcide with the selected filters
  do {
    $yearname = $year_aa['yearname'];
    $yearID = $year_aa['yearID'];

    $questionID_sql = "SELECT DISTINCT question.levelID, level.levelname FROM question INNER JOIN level on question.levelID = level.levelID WHERE question.yearID = $yearID and question.levelID $levelsql";
    $questionID_qry = mysqli_query($dbconnect, $questionID_sql);
    if (mysqli_num_rows($questionID_qry)==0) {
      continue;
    } else {
      $questionID_aa = mysqli_fetch_assoc($questionID_qry);
    }

    do {
      $levelname = $questionID_aa['levelname'];
      $levelID = $questionID_aa['levelID']; ?>


      <div class='border col-6'>
        <input type="checkbox" style='display:none;' id="Qclick <?php echo "$yearname $levelname"; ?>" onclick="send_selected(<?php echo "'$yearID'"; ?>, <?php echo "'$levelID'"; ?>)">
        <label for='Qclick <?php echo "$yearname $levelname"; ?>'>
        <div class='row'>
  <?php # Gets the filename of the image for the question
          echo "<div class='col-4 text-center'>";
            echo nl2br("$yearname \n");
            echo nl2br("year $levelname \n");
          echo "</div>";

          echo "<div class='col-8'>";
  # displays the image with the filename
            echo "<h4>Past Paper</h4>";
          echo "</div>";
          echo "</div>";
        echo "</label>";
      echo "</div>";


  # Repeats until all questions have been displayed
    } while ($questionID_aa = mysqli_fetch_assoc($questionID_qry));
} while ($year_aa = mysqli_fetch_assoc($year_qry));
echo "</div>";
} ?>
