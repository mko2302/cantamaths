<?php

include("dbconnect.php");

include("filter-to-in.php");

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

//select all qs from database
$number_sql = "SELECT * FROM question WHERE question.yearID $yearsql AND question.levelID $levelsql AND question.questionID $questionIDsql";
$number_qry = mysqli_query($dbconnect, $number_sql);
$number_of_q = mysqli_num_rows($number_qry);

//pagination code adapted from https://github.com/simonjsuh/pagination-in-php/blob/master/index.php

//set number of results displyed per page
$results_per_page = 6;

//find number of pages needed to display all questions
$number_of_pages = ceil($number_of_q/$results_per_page);

//find number page user is on
if (!isset($_POST['page'])) {
  $page = 1;
} else {
  $page = $_POST['page'];
}

$page_first_result = ($page - 1) * $results_per_page;

//sql query to get number of questions depending on what page user is on
$question_sql = "SELECT * FROM question
                INNER JOIN year ON question.yearid = year.yearID
                INNER JOIN level ON question.levelID = level.levelID
                WHERE question.yearID $yearsql AND question.levelID $levelsql AND question.questionID $questionIDsql
                ORDER BY yearname DESC, levelname ASC, qnumber ASC
                LIMIT $page_first_result , $results_per_page ";

$question_qry = mysqli_query($dbconnect, $question_sql);

 ?>

<!-- bootstrap table to display questions -->
<table class="table table-striped admin-table" id="dbTable">
  <thead>
    <tr>
      <th scope="col">
        Question #<br>
        Year Group<br>
        Competition Year
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
      echo "<td colspan=6'><p class='display-3 text-center p-5'>No Questions in Database</p></td>";
    } else {

      $question_aa = mysqli_fetch_assoc($question_qry);

        do {
            //take all data from assosicative array and assign variables
            $questionID = $question_aa["questionID"];
            $question_yearID = $question_aa["yearID"];
            $question_year = $question_aa["yearname"];
            $question_levelID = $question_aa["levelID"];
            $question_level = $question_aa["levelname"];
            $qnumber = $question_aa["qnumber"];
            $filename = $question_aa["filename"];
            $answer = $question_aa["answer"];
            $year = $question_aa["yearname"];

            ?>
            <tr class="admin-table-row">
              <!-- questions/year/level coloumn -->
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
                        $name = $questiontag_aa['tagname'];
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
                <button type='button' class='btn btn-primary' id='editButton' <?php echo"data-id='$questionID'";?>>
                  Edit
                </button>
              </td>

              <!-- edit modal -->
              <div class='modal fade' id='editModal' tabindex='-1' role='dialog'>
                <div class='modal-dialog modal-lg modal-dialog-centered' role='document'>
                  <div class='modal-content edit-content'>
                    <!-- modal content gets delivered through another page -->
                  </div>
                </div>
              </div>

              <!-- submit edit form -->
              <script type="text/javascript">
                $(document).ready(function () {

                 $("editForm").submit(function (event) {
                   $.ajax({
                     type: "POST",
                     url: form.attr( 'action' ),
                     data: form.serialize(),
                     dataType: "json",
                     encode: true,
                   }).done(function (data) {
                     console.log(data);
                   });

                   event.preventDefault();
                 });
               });
              </script>


              <!-- Open edit Modal script -->
              <script type='text/javascript'>
              $(document).ready(function(){

                //delegate the event using "on" to make ajax function properly
                $('#Custom_Database').on('click','#editButton',function(e){
                  // e.preventDefault();
                     e.preventDefault();
                    //question id is the one user clicked on
                    var questionID = $(this).data('id');

                    // AJAX request
                    $.ajax({
                        url: 'editmodal.php',
                        type: 'POST',
                        data: {questionID: questionID},
                        success: function(response){
                            // Add response in Modal body
                            $('.edit-content').html(response);

                            // Display Modal
                            $('#editModal').modal('show');
                          }
                      });
                  });
                });
              </script>

              <!-- delete button column -->
              <td>
                <button type='button' class='btn btn-danger' id='deleteButton' <?php echo"data-id='$questionID'";?>>
                  Delete
                </button>
              </td>

              <div class='modal fade' id='deleteModal' tabindex='-1' role='dialog'>
                <div class='modal-dialog modal-lg modal-dialog-centered' role='document'>
                  <div class='modal-content delete-content'>

                  </div>
                </div>
              </div>

              <script type='text/javascript'>
              $(document).ready(function(){

                //delegate the event using "on" to make ajax function properly
                $('#Custom_Database').on('click','#deleteButton',function(e){
                  // e.preventDefault();
                     e.preventDefault();
                    //question id is the one user clicked on
                    var questionID = $(this).data('id');

                    // AJAX request
                    $.ajax({
                        url: 'deletemodal.php',
                        type: 'POST',
                        data: {questionID: questionID},
                        success: function(response){
                            // Add response in Modal body
                            $('.delete-content').html(response);

                            // Display Modal
                            $('#deleteModal').modal('show');
                          }
                      });
                  });
                });
              </script>

            </tr>

        <?php
          } while ($question_aa = mysqli_fetch_assoc($question_qry));
        };
        ?>
  </tbody>
</table>



<!-- pagination boostrap adapted from https://www.positronx.io/create-pagination-in-php-with-mysql-and-bootstrap/ -->
<nav aria-label="Page navigation mt-5">
    <ul class="pagination justify-content-center my-1">
      <?php
      if($page > 1){
        // make make previous button so to previous page
        $previous = $page - 1;
        echo "<li class='page-item page-clickable first-child' value='$previous'><span class='page-link'>Previous</span></li>";
      } else {
        // is page is not > 1, disable the button
        echo "<li class='page-item disabled first-child'><span class='page-link'>Previous</span></li>";
      }

      // number pagination
        // for the number of pages
      for($i = 1; $i <= $number_of_pages; $i++ ):
        if ($page == $i) {
          // if the page button is the current page, make it display as active
          echo "<li class='page-clickable page-item active' value='$i'>
                  <a class='page-link page-active'>$i</a>
                </li>";
        } else {
          // else just display as normal
          echo "<li class='page-clickable page-item' value='$i'>
                  <a class='page-link'>$i</a>
                </li>";
        }
       endfor;

       // next button
        // if current page is >= to the total number of pages
       if ($page == $number_of_pages) {
         // disable the next button
         echo "<li class='page-item disabled last-child'><span class='page-link'>Next</span></li>";
       } else {
         // otherwise make button go to next page
         $next = $page + 1;
         echo "<li class='page-item page-clickable last-child' value='$next'><span class='page-link'>Next</span></li>";
       }
       ?>

    </ul>
</nav>
