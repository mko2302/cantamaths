<?php
// check to see if logged in.
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
} else {

//status
if(!isset($_GET['status'])) {
  echo "";
} else {
  $status = $_GET['status'];
  if ($status == "nonimage") {
    echo "<div class='alert alert-warning' role='alert'>
            File uploaded is not an image!
         </div>";
  }
  if ($status == "duplicate") {
     echo "<div class='alert alert-danger' role='alert'>
              IMAGE or  QUESTION with question number, publication year and year level already exists!
          </div>";
  }
  if ($status == "error") {
    echo "<div class='alert alert-danger' role='alert'>
             Error has occured
         </div>";
  }
  if ($status == "success") {
    echo "<div class='alert alert-success' role='alert'>
             New question added!
         </div>";
  }
      }
  ?>
  <form action="index.php?page=adminpanel&tab=enterquestion" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="form-group col-lg-6">
          <label class="form-label" for="fileToUpload">Upload Question Image</label> <br>
          <input class="" type="file" name="fileToUpload" id="fileToUpload" accept="image/*" onchange="loadFile(event)" multiple>
        </div>
      </div>

      <div class="row align-items-center">
        <!-- enter qusetion number -->
        <div class="form-group col-2">
          <label for="qnumber">Question Number</label><br>
          <input class="form-control" id="qnumber" name="qnumber" type="number" placeholder="Enter Number" min="1" max="20">
          <script>
            document.querySelector("input[type=number]")
            .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
          </script>
        </div>
        <!-- script to load image when user upload -->
        <div class="col-lg-2">
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

        <!-- input for answer -->
        <div class="form-group col-lg-2">
          <label for="answer">Answer</label><br>
          <input class="form-control" type="text" name="answer" placeholder="Enter Answer">
        </div>

        <!-- select/type year of publication -->
        <div class="form-group col-lg-1.5">
          <label for="year">Publication Year</label><br>
          <select class="form-control" name="year">
            <?php
              $year_sql = "SELECT * FROM year ORDER BY yearID DESC";
              $year_qry = mysqli_query($dbconnect, $year_sql);
              $year_aa = mysqli_fetch_assoc($year_qry);

              do {

                $yearID = $year_aa['yearID'];
                $name = $year_aa['name'];

                echo " <option value='$yearID'>$name</option>";

              } while ($year_aa = mysqli_fetch_assoc($year_qry));
              ?>
          </select>
        </div>

        <!-- select/type year level -->
        <div class="form-group col-lg-1">
          <label for="level">Year Level</label><br>
          <select name="level" class="form-control">
            <?php
            $level_sql = "SELECT * FROM level";
            $level_qry = mysqli_query($dbconnect, $level_sql);
            $level_aa = mysqli_fetch_assoc($level_qry);

            do {

              $levelID = $level_aa['levelID'];
              $name = $level_aa['name'];

              echo " <option value='$levelID'>Year $name</option>";

            } while ($level_aa = mysqli_fetch_assoc($level_qry));
            ?>
          </select>
        </div>
      </div>

      <div class="form-group col-lg-2">

          <script type="text/javascript">
            $(document).ready(function() {
              $('#tag').multiselect({
                nonSelectedText: 'Select Tags'
              });
            });
          </script>

          <select class="form-control" id="tag" name="tag[]" multiple>
            <?php
            $tag_sql = "SELECT * FROM tag";
            $tag_qry = mysqli_query($dbconnect, $tag_sql);
            $tag_aa = mysqli_fetch_assoc($tag_qry);

            do {

              $tagID = $tag_aa['tagID'];
              $name = $tag_aa['name'];

              echo " <option value='$tagID'>$name</option>";

            } while ($tag_aa = mysqli_fetch_assoc($tag_qry));
            ?>
          </select>

      </div>


    <div class="row">
      <div class="col-3">
        <button type="submit" class="btn btn-primary">Add Question</button>
      </div>
    </div>
  </form>
  <?php
}
?>
