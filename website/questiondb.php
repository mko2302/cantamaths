<?php
//select all qs from database
$number_sql = "SELECT * FROM question";
$number_qry = mysqli_query($dbconnect, $number_sql);
$number_of_q = mysqli_num_rows($number_qry);

//pagination code adapted from https://github.com/simonjsuh/pagination-in-php/blob/master/index.php

//set number of results displyed per page
$results_per_page = 6;

//find number of pages needed to display all questions
$number_of_pages = ceil($number_of_q/$results_per_page);

//find number page user is on
if (!isset($_GET['qpage'])) {
  $qpage = 1;
} else {
  $qpage = $_GET['qpage'];
}

$page_first_result = ($qpage - 1) * $results_per_page;

//sql query to get number of questions depending on what page user is on
$question_sql = "SELECT *, year.name AS year, level.name AS level FROM question
                INNER JOIN year ON question.yearid = year.yearID
                INNER JOIN level ON question.levelID = level.levelID
                LIMIT $page_first_result , $results_per_page ";

$question_qry = mysqli_query($dbconnect, $question_sql);

 ?>

<!-- bootstrap table -->
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">
        Question #<br>
        Year Group<br>
        Publication Year
      </th>
      <th>Tags</th>
      <th>Question</th>
      <th>Answer</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>

    <?php
    // error catching if no results
    if(mysqli_num_rows($question_qry) == 0) {
      echo "<p class='display-2 text-center p-5'>No Questions in Database</p>";
    } else {

      $question_aa = mysqli_fetch_assoc($question_qry);

        do {
            $questionID = $question_aa["questionID"];
            $question_yearID = $question_aa["yearID"];
            $question_year = $question_aa["year"];
            $question_levelID = $question_aa["levelID"];
            $question_level = $question_aa["level"];
            $qnumber = $question_aa["qnumber"];
            $filename = $question_aa["filename"];
            $answer = $question_aa["answer"];
            $year = $question_aa["year"];

            ?>
            <tr>
              <!-- question/year/level coloumn -->
              <td>
                Question <?php echo "$qnumber";?><br>
                Year <?php echo "$question_level";?><br>
                <?php echo "$question_year";?>
              </td>

              <!-- tag column -->
              <td>
              <?php
                  // make array for tag list
                  $taglist = array();

                  $questiontag_sql = "SELECT * FROM questiontag JOIN tag ON questiontag.tagID = tag.tagID  WHERE questionID = $questionID";
                  $questiontag_qry = mysqli_query($dbconnect, $questiontag_sql);

                  if(mysqli_num_rows($questiontag_qry) == 0) {
                    echo "No tags";
                  } else {
                    // add tags to tag list
                    $questiontag_aa = mysqli_fetch_assoc($questiontag_qry);
                      do {
                        $tagID = $questiontag_aa['tagID'];
                        $name = $questiontag_aa['name'];
                        $single_tag = array("$tagID", "$name");
                        array_push($taglist, $single_tag);
                      } while ($questiontag_aa = mysqli_fetch_assoc($questiontag_qry));

                      if(count($taglist) == 0) {
                        echo "No tags for this question";
                      } else {
                        foreach ($taglist as $tag) {
                          echo "$tag[1]<br>";
                        }
                      }
                    }
               ?>

              </td>

              <!-- question image column -->
              <td><img style='height:100px' <?php echo"src='questions/$filename'"?> alt=''></td>

              <!-- answer column -->
              <td><?php echo"$answer"; ?></td>

              <!-- edit button column -->
              <td>
                <button type='button' class='btn btn-primary' data-toggle='modal' <?php echo"data-target='#editquestion_$qnumber'";?>>
                  Edit
                </button>
              </td>

              <!-- delete button column -->
              <td>
                <button type='button' class='btn btn-primary' data-toggle='modal' <?php echo"data-target='#deletequestion_$qnumber'";?>>
                  Delete
                </button>
              </td>

              <!-- Modal script -->
              <script>
              $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
              })
              </script>

              <!-- edit modal -->
              <div class='modal fade' <?php echo"id='editquestion_$qnumber'";?> tabindex='-1' role='dialog'>
                <div class='modal-dialog modal-lg modal-dialog-centered' role='document'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h5 class='modal-title' <?php echo "id='editquestion_$qnumber"?> >Edit Question</h5>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>

                    <div class='modal-body'>
                      <img style='width:100%;' <?php echo"src='questions/$filename'";?> alt=''>
                    <?php echo" <form class='' action='index.php?page=adminpanel&tab=editquestion&questionID=$questionID' method='post'>";?>

                      <!-- question number -->
                      <div class='row'>
                        <div class='form-group col'>
                          <label for='qnumber'>Question Number</label><br>
                          <input class='form-control' id='qnumber' name='qnumber' id='qnumber' type='number' <?php echo"value='$qnumber'";?> min='1' max='20'>
                          <script>
                            document.querySelector('input[type=number]')
                            .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                          </script>
                        </div>

                        <!-- input for answer -->
                        <div class='form-group col'>
                          <label for='answer'>Answer</label><br>
                          <input class='form-control' type='text' name='answer' <?php echo"value='$answer'"?>>
                        </div>
                      </div>

                      <div class="row">
                      <!-- year -->
                      <div class='form-group col'>
                        <label for='year'>Publication Year</label><br>

                        <select class='form-control' name='year'>
                          <?php
                            $year_sql = 'SELECT * FROM year ORDER BY yearID DESC';
                            $year_qry = mysqli_query($dbconnect, $year_sql);
                            $year_aa = mysqli_fetch_assoc($year_qry);

                            do {
                              $yearID = $year_aa['yearID'];
                              $name = $year_aa['name'];

                              if ($question_yearID == $yearID) {
                                echo " <option value='$yearID' selected>$name</option>";
                              } else {
                                echo " <option value='$yearID'>$name</option>";
                              }

                            } while ($year_aa = mysqli_fetch_assoc($year_qry));
                          ?>
                        </select>
                      </div>

                        <!-- select/type year level -->
                        <div class="form-group col">
                          <label for="level">Year Level</label><br>
                          <select name="level" class="form-control" required>
                            <?php
                            $level_sql = "SELECT * FROM level";
                            $level_qry = mysqli_query($dbconnect, $level_sql);
                            $level_aa = mysqli_fetch_assoc($level_qry);

                            do {
                              $levelID = $level_aa['levelID'];
                              $name = $level_aa['name'];

                              if ($question_levelID == $levelID) {
                                echo " <option value='$levelID' selected>$name</option>";
                              } else {
                                echo " <option value='$levelID'>$name</option>";
                              }

                            } while ($level_aa = mysqli_fetch_assoc($level_qry));
                            ?>
                          </select>
                        </div>
                      </div>

                      <!-- edit tags -->
                      <div class='form-group col-lg-2'>
                        <?php
                        $tag_sql = "SELECT * FROM tag";
                        $tag_qry = mysqli_query($dbconnect, $tag_sql);
                        $tag_aa = mysqli_fetch_assoc($tag_qry);

                        do {
                          $tagID = $tag_aa["tagID"];
                          $name = $tag_aa["name"];

                          // if the tag ID is in the tag list array in the column 0 of nested array for each tag
                          if(array_search($tagID, array_column($taglist, 0)) !== false) {
                            // display as checked
                                echo "
                                <div class='form-check'>
                                  <input class='form-check-input' name='tag[]' type='checkbox' value='$tagID' id='checkbox_$tagID' checked>
                                  <label class='form-check-label' for='checkbox_$tagID'>
                                    $name
                                  </label>
                                </div>";
                              } else {
                                // unchecked
                                echo "
                                <div class='form-check'>
                                  <input class='form-check-input' name='tag[]' type='checkbox' value='$tagID' id='checkbox_$tagID'>
                                  <label class='form-check-label' for='checkbox_$tagID'>
                                    $name
                                  </label>
                                </div>";
                              }

                          } while ($tag_aa = mysqli_fetch_assoc($tag_qry));
                         ?>

                      </div>
                    </div>

                    <div class='modal-footer'>
                      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                      <button type='button submit' class='btn btn-primary'>Save changes</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>


              <!-- delete modal -->
              <div class='modal fade' <?php echo"id='deletequestion_$qnumber'";?> tabindex='-1' role='dialog'>
                <div class='modal-dialog modal-lg modal-dialog-centered' role='document'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h5 class='modal-title' <?php echo "id='deletequestion_$qnumber"?> >Delete Question</h5>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>

                    <div class='modal-body'>
                        <!-- question image column -->
                        <img style='height:100px' <?php echo"src='questions/$filename'"?> alt=''>

                        <div class="row">
                          Question <?php echo "$qnumber";?><br>
                          Year <?php echo "$question_level";?><br>
                          <?php echo "$question_year";?>

                          <!-- tag column -->
                          <?php
                          foreach ($taglist as $tag) {
                            echo "$tag[1]<br>";
                          }
                           ?>
                        </div>
                    </div>

                    <div class='modal-footer'>
                        <p>Are you sure?</p>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                        <?php echo "<a href='index.php?page=adminpanel&tab=deletequestion&questionID=$questionID'><button type='button' class='btn btn-primary'>Delete Question</button></a>";?>

                    </div>
                  </div>
                </div>
              </div>

            </tr>

        <?php
          } while ($question_aa = mysqli_fetch_assoc($question_qry));
        };
        ?>
  </tbody>
</table>

<!-- pagination boostrap adapted from https://www.positronx.io/create-pagination-in-php-with-mysql-and-bootstrap/ -->
<nav aria-label="Page navigation example mt-5">
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
                echo "index.php?page=adminpanel&tab=questiondb&qpage=$prev";
              } ?>
              ">Previous</a>
        </li>

        <!-- page number button -->
        <?php for($i = 1; $i <= $number_of_pages; $i++ ): ?>
        <li class="page-item <?php if($qpage == $i) {echo 'active'; } ?>">
            <a class="page-link" href="index.php?page=adminpanel&tab=questiondb&qpage=<?= $i; ?>"> <?= $i; ?> </a>
        </li>
        <?php endfor; ?>

        <!-- next button -->
        <li class="page-item <?php if($page >= $number_of_pages) { echo 'disabled'; } ?>">
            <a class="page-link"
              <?php $next = ($qpage + 1) ?>
                href="
              <?php
                if($page >= $number_of_pages){
                  echo '#';
                } else {
                  echo "index.php?page=adminpanel&tab=questiondb&qpage=$next";
                } ?>
                ">Next</a>
        </li>
    </ul>
</nav>
