<?php
// check to see if logged in.
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
} else {

  include("status.php");
  ?>
<div class="admin-add-container">
  <h2>Add Question</h2><br>
  <!-- form for entering question -->
  <form action="index.php?page=adminpanel&tab=enterquestion" method="post" enctype="multipart/form-data">
      <div class="col-12">
        <div class="row">
          <div class="form-group col-lg-8">
            <label class="form-label" for="fileToUpload">Upload Question Image</label> <br>
            <input class="" type="file" name="fileToUpload" id="fileToUpload" accept="image/*" onchange="loadFile(event)">
          </div>
        </div>

        <div class="row">
          <!-- script to load image when user upload -->
          <div class="col">
            <img id="output" height="150" class="questionimg">
            <script>
              var loadFile = function(event) {
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                  URL.revokeObjectURL(output.src) // free memory
                }
              };
            </script>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="row">
              <!-- enter qusetion number -->
              <div class="form-group col-lg-4">
                <label for="qnumber">Question Number</label><br>
                <!-- select question number 1 to 20 -->
                <input class="form-control" id="qnumber" name="qnumber" type="number" placeholder="Enter Number" min="1" max="20" required>
                <!-- script to display numbers in selector -->
                <script>
                  document.querySelector("input[type=number]")
                  .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                </script>
              </div>

              <!-- input for answer -->
              <div class="form-group col-lg-4">
                <label for="answer">Answer</label><br>
                <input class="form-control" type="text" name="answer" placeholder="Enter Answer" required>
              </div>
            </div>

            <div class="row">
              <!-- select year of competition -->
              <div class="form-group col-lg-4">
                <label for="year">Competition Year</label><br>
                <select class="form-control" name="year" required>
                  <?php
                  // select all years from database
                    $year_sql = "SELECT * FROM year ORDER BY yearID DESC";
                    // send query to database
                    $year_qry = mysqli_query($dbconnect, $year_sql);
                    //fetch results as assocative array
                    $year_aa = mysqli_fetch_assoc($year_qry);

                    // display each year as a select option
                    do {

                      $yearID = $year_aa['yearID'];
                      $name = $year_aa['yearname'];

                      echo " <option value='$yearID'>$name</option>";

                    } while ($year_aa = mysqli_fetch_assoc($year_qry));
                    ?>
                </select>
              </div>

              <!-- select/type year level -->
              <div class="form-group col-lg-4">
                <label for="level">Year Level</label><br>
                <select name="level" class="form-control" required>
                  <?php
                  $level_sql = "SELECT * FROM level";
                  $level_qry = mysqli_query($dbconnect, $level_sql);
                  $level_aa = mysqli_fetch_assoc($level_qry);

                  do {

                    $levelID = $level_aa['levelID'];
                    $name = $level_aa['levelname'];

                    echo " <option value='$levelID'>Year $name</option>";

                  } while ($level_aa = mysqli_fetch_assoc($level_qry));
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group">
            <!-- select tags -->
              <label for=""><h4>Select Tags</h4></label>
              <div class="row">
                <?php
                // select all tags from database
                  $num_tag_sql = "SELECT * FROM tag";
                  // send query to database
                  $num_tag_qry = mysqli_query($dbconnect, $num_tag_sql);
                  //count number of tabs
                  $tag_count = mysqli_num_rows($num_tag_qry);

                  if ($tag_count == 0) {
                    echo"<h2>No tags in database!</h2>";
                  } else {
                    $number_of_columns = 6;
                    $tag_per_col = ceil($tag_count / $number_of_columns);

                    for ($i=0; $i < $number_of_columns; $i++) {
                      $first_result = ($i) * $tag_per_col;
                      $tag_sql = "SELECT * FROM tag LIMIT $first_result, $tag_per_col ";
                      $tag_qry = mysqli_query($dbconnect, $tag_sql);
                      $tag_aa = mysqli_fetch_assoc($tag_qry);

                      echo "<div class='col'>";
                      do {
                        $tagID = $tag_aa['tagID'];
                        $name = $tag_aa['tagname'];
                        // display each tag as a checkbox
                        echo "
                        <div class='form-check'>
                          <input class='form-check-input' name='tag[]' type='checkbox' value='$tagID' id='checkbox_$tagID'>
                          <label class='form-check-label' for='checkbox_$tagID'>
                          $name
                          </label>
                        </div>";
                        } while ($tag_aa = mysqli_fetch_assoc($tag_qry));
                      echo "</div>";
                    }
                  }

                ?>
              </div>
            </div>
          </div>
        </div>
    <div class="row">
      <!-- submit button -->
      <div class="col-3">
        <button type="submit" class="btn btn-primary">Add Question</button>
      </div>
    </div>
  </form>
</div>

<?php
  }
 ?>
