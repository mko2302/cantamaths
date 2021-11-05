<?php
  include("dbconnect.php");

  if (isset($_POST['questionID'])){
    $questionID = $_POST['questionID'];
    $question_sql = "SELECT * FROM question
                    INNER JOIN year ON question.yearid = year.yearID
                    INNER JOIN level ON question.levelID = level.levelID
                    WHERE questionID = $questionID";

    $question_qry = mysqli_query($dbconnect, $question_sql);
    $question_aa = mysqli_fetch_assoc($question_qry);

    //individual variables
    $questionID = $question_aa["questionID"];
    $question_yearID = $question_aa["yearID"];
    $question_year = $question_aa["yearname"];
    $question_levelID = $question_aa["levelID"];
    $question_level = $question_aa["levelname"];
    $qnumber = $question_aa["qnumber"];
    $filename = $question_aa["filename"];
    $answer = $question_aa["answer"];
    $year = $question_aa["yearname"];
  }
 ?>
 <?php echo" <form class='' id='editForm$questionID' name='editForm' action='index.php?page=editquestion&questionID=$questionID' method='post'>";?>
 <div class='modal-header'>
   <h5 class='modal-title'>Edit Question</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
   </button>
 </div>

 <div class='modal-body'>
 <img style='width:100%;' <?php echo"src='questions/$filename'";?> alt=''>

   <!-- question number -->
   <div class='row'>
     <div class='form-group col'>
       <label <?php echo"for='edit_qnumber_$questionID'";?>>Question Number</label><br>
       <input class='form-control' name='qnumber' id='qnumber' type='number' <?php echo"value='$qnumber'";?> min='1' max='20' required>
       <script>
         document.querySelector('input[type=number]')
         .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
       </script>
     </div>

     <!-- input for answer -->
     <div class='form-group col'>
       <label for='answer'>Answer</label><br>
       <input class='form-control' type='text' name='answer' <?php echo "id='answer' value='$answer'";?> required>
     </div>
   </div>

   <div class="row">
   <!-- year -->
   <div class='form-group col'>
     <label for='year'>Publication Year</label><br>

     <select class='form-control' name='year' required <?php echo"id='year'"; ?>>
       <?php
         $year_sql = 'SELECT * FROM year ORDER BY yearID DESC';
         $year_qry = mysqli_query($dbconnect, $year_sql);
         $year_aa = mysqli_fetch_assoc($year_qry);

         do {
           $yearID = $year_aa['yearID'];
           $name = $year_aa['yearname'];

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
       <select name="level" class="form-control" id='level' required>
         <?php
         $level_sql = "SELECT * FROM level";
         $level_qry = mysqli_query($dbconnect, $level_sql);
         $level_aa = mysqli_fetch_assoc($level_qry);

         do {
           $levelID = $level_aa['levelID'];
           $name = $level_aa['levelname'];

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
   <div class='form-group'>
     <div class="row">
       <?php
       $tag_sql = "SELECT * FROM tag";
       $tag_qry = mysqli_query($dbconnect, $tag_sql);
       $tag_aa = mysqli_fetch_assoc($tag_qry);

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
         }

       // select all tags from database
       $num_tag_sql = "SELECT * FROM tag";
       // send query to database
       $num_tag_qry = mysqli_query($dbconnect, $num_tag_sql);
       //count number of tabs
       $tag_count = mysqli_num_rows($num_tag_qry);

       if ($tag_count == 0) {
         echo"<h2>No tags in database!</h2>";
       } else {
         $number_of_columns = 3;
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
             // if the tag ID is in the tag list array in the column 0 of nested array for each tag
             if(array_search($tagID, array_column($taglist,0)) !== false) {
               // display as checked
                   $checked = "checked";
                 } else {
                   $checked = "";
                 }
             // display each tag as a checkbox
             echo "
             <div class='form-check'>
               <input class='form-check-input' id='tag' name='tag[]' type='checkbox' value='$tagID' id='editForm' $checked>
               <label class='form-check-label' for='edit-$tagID-$questionID'>
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

 <div class='modal-footer'>
   <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
   <button type='submit' class='btn btn-primary'>Save changes</button>
 </div>
 </form>
