<?php
  $questionID = $_GET['questionID'];
  $qnumber = $_POST['edit_qnumber_' . $questionID];
  $answer = $_POST['answer'];
  $year = $_POST['year'];
  $level = $_POST['level'];

  //array for tags from database
  $taglist_db = array();
  //gets all tags for the questionID
  $tag_check_sql = "SELECT * FROM questiontag WHERE questionID = $questionID";
  $tag_check_qry = mysqli_query($dbconnect, $tag_check_sql);
  $tag_check_aa = mysqli_fetch_assoc($tag_check_qry);
  do { //put all tags in the database into an array
    $tagID = $tag_check_aa["tagID"];
    array_push($taglist_db, $tagID);
  } while ($tag_check_aa = mysqli_fetch_assoc($tag_check_qry));

  //if tag array isset
  if (isset($_POST['tag'])) {
    //tags from edit page
    $taglist_form = $_POST['tag'];
  }

  // check if any questions in database are the same
  $check_sql = "SELECT * FROM question WHERE qnumber = $qnumber AND levelID = $level and yearID = $year";
  //send to database
  $check_qry = mysqli_query($dbconnect, $check_sql);

  if ((mysqli_num_rows($check_qry) > 0) && (sort($taglist_db) === sort($taglist_form)) && (array_count_values($taglist_db) == array_count_values($taglist_form))){
    //as the question and tags connected to it sent by the user matched exactly to the database
    //send user back to the database page with the error
    header("Location:index.php?page=adminpanel&tab=questiondb&status=duplicateq");
  } else {
    if(isset($_POST['tag'])){
      //list of items to delete from database
      $delete_list = array_diff($taglist_db, $taglist_form);
      //array of items
      $insert_list = array_diff($taglist_form, $taglist_db);
    } else {
      //delete all tags from database
      $delete_tag_sql = "DELETE FROM questiontag WHERE questionID=$questionID";
      // sends sql query to data base
      $delete_tag_qry = mysqli_query($dbconnect, $delete_tag_sql);
    }

    //if question is in database and there are no tags to changes
    if ((mysqli_num_rows($check_qry) == 0)) {
      //get year from db
      $originalq_sql = "SELECT * FROM question INNER JOIN year ON question.yearid = year.yearID INNER JOIN level ON question.levelID = level.levelID WHERE questionID = $questionID";
      $originalq_qry = mysqli_query($dbconnect, $originalq_sql);
      $originalq_aa = mysqli_fetch_assoc($originalq_qry);
      $original_filename = $originalq_aa['filename'];

      //get year from db
      $year_sql = "SELECT yearname FROM year WHERE yearID = $year";
      $year_qry = mysqli_query($dbconnect, $year_sql);
      $year_aa = mysqli_fetch_assoc($year_qry);
      $file_year = $year_aa['yearname'];

      //get level from db
      $level_sql = "SELECT levelname FROM level WHERE levelID = $level";
      $level_qry = mysqli_query($dbconnect, $level_sql);
      $level_aa = mysqli_fetch_assoc($level_qry);
      $file_level = $level_aa['levelname'];

      // gets file extenetion
      $path_parts = pathinfo($original_filename);
      $extension = $path_parts['extension'];

      //creates new file name
      $new_filename = $file_year . "-" . $file_level . "-" . $qnumber . "." . $extension;
      $new_filename_path = "questions/" . $new_filename;
      //renames file in folder
      rename("questions/$original_filename", "$new_filename_path");

      //update questiondb sql
      $update_sql = "UPDATE question
                     SET qnumber = '$qnumber', answer = '$answer', levelID = '$level', yearID = '$year', filename = '$new_filename'
                     WHERE questionID = $questionID";

      //send to database
      $update_qry = mysqli_query($dbconnect, $update_sql);
    }

    //update taglist_form isset
    if (isset($taglist_form)) {
      // for each item in delete tag list delete tag
      foreach($delete_list as $delete_tagID) {
        //deletes previous tags
        $delete_tag_sql = "DELETE FROM questiontag WHERE questionID=$questionID and tagID = $delete_tagID";
        // sends sql query to data base
        $delete_tag_qry = mysqli_query($dbconnect, $delete_tag_sql);
      }
      // for each item in insert tag list add the tag
      foreach($insert_list as $insert_tagID) {
        //adds new tags
        $add_tag_sql = "INSERT INTO questiontag (questionID, tagID) VALUES ($questionID, $insert_tagID)";

        $add_tag_qry = mysqli_query($dbconnect, $add_tag_sql);
      }
    } else {
      //delete all tags from database
      $delete_tag_sql = "DELETE FROM questiontag WHERE questionID=$questionID";
      // sends sql query to data base
      $delete_tag_qry = mysqli_query($dbconnect, $delete_tag_sql);
    }
    //sends user back to page as edit was successful
    header("Location:index.php?page=adminpanel&tab=questiondb&status=editsuccess");
  }

 ?>
