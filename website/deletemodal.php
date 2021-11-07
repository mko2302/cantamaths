<?php
include("dbconnect.php");

// if question ID is set from post array
if (isset($_POST['questionID'])){
  // define variable
  $questionID = $_POST['questionID'];
  // select all questions from databse where same questionID
  $question_sql = "SELECT * FROM question
                  INNER JOIN year ON question.yearid = year.yearID
                  INNER JOIN level ON question.levelID = level.levelID
                  WHERE questionID = $questionID";

  // send query to database
  $question_qry = mysqli_query($dbconnect, $question_sql);
  // put results in assosiative array
  $question_aa = mysqli_fetch_assoc($question_qry);

  //individual variables
  $questionID = $question_aa["questionID"];
  $question_year = $question_aa["yearname"];
  $question_level = $question_aa["levelname"];
  $qnumber = $question_aa["qnumber"];
  $filename = $question_aa["filename"];
  $answer = $question_aa["answer"];
  $year = $question_aa["yearname"];
}
 ?>

<!-- delete modal -->

      <div class='modal-header'>
        <h5 class='modal-title'>Delete Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class='modal-body justify-center'>
        <div class="col-12 p-2">
          <!-- question image column -->
          <div class="row">
            <img style='width:100%;' <?php echo"src='questions/$filename'"?> alt=''>

          </div>

          <div class="row my-2">
            <div class="col-2">
              <h3>Details</h3>
            </div>
            <div class="col-8">
              Question: <?php echo "$qnumber";?><br>
              Level: <?php echo "$question_level";?><br>
              Year: <?php echo "$question_year";?>
            </div>
          </div>

          <div class="row my-2">
            <div class="col-2">
              <h3>Tags</h3>
            </div>
            <div class="col-8">
              <!-- tag column -->
              <?php
              // get all questions from junction table where questionID
              $questiontag_sql = "SELECT * FROM questiontag JOIN tag ON questiontag.tagID = tag.tagID  WHERE questionID = $questionID";
              $questiontag_qry = mysqli_query($dbconnect, $questiontag_sql);

              // error catching for if no questions exist
              if(mysqli_num_rows($questiontag_qry) == 0) {
                echo "No tags";
              } else {
                // display all the tags related to question
                $questiontag_aa = mysqli_fetch_assoc($questiontag_qry);
                  do {
                    $tagname = $questiontag_aa['tagname'];
                    echo "$tagname<br>";

                  } while ($questiontag_aa = mysqli_fetch_assoc($questiontag_qry));
                }
              ?>
            </div>
          </div>
        </div>
      </div>

      <div class='modal-footer'>
          <p>Are you sure?</p>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
          <?php echo "<button type='button' class='btn btn-danger'>Delete Question</button>";?>

      </div>
