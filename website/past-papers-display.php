<?php include("filter-to-in.php");


$year_sql = "SELECT DISTINCT question.yearID, year.yearname FROM question INNER JOIN year ON question.yearID = year.yearID WHERE question.yearID $yearsql";
$year_qry = mysqli_query($dbconnect, $year_sql);
if (mysqli_num_rows($year_qry)==0) {
} else {
  $year_aa = mysqli_fetch_assoc($year_qry); ?>


  <div class="py-2">
    <div class="py-1 px-2 border-header">
      <p style="margin: 0px; font-weight: 500;">Results to of</p>
    </div>
  </div>


  <?php echo "<div class='container-fluid row pt-1' style='margin: 0px; padding: 0px;'>";
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


        <div class='border-sub mb-2 col-6' style="padding: 0px;">
          <input type="checkbox" style='display:none;' id="Qclick <?php echo "$yearname $levelname"; ?>" onclick="send_selected(<?php echo "'$yearID'"; ?>, <?php echo "'$levelID'"; ?>)">
          <label class="container-fluid" style="margin: 0px; height: 88px;"for='Qclick <?php echo "$yearname $levelname"; ?>'>
            <div class='row'>
              <?php echo "<div style='padding: 0px; line-height: 1.4; top: 50%;' class='col-4 text-center'>";
                echo nl2br("$yearname \n");
                echo nl2br("year $levelname \n");
              echo "</div>";

              echo "<div class='col-8' style='padding: auto;'>";
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
