<?php
  $questionID = $_GET['questionID'];
  $qnumber = $_POST['qnumber'];
  $answer = $_POST['answer'];
  $year = $_POST['year'];
  $level = $_POST['level'];

  //array for tags from database
  $taglist_db = array();

  //if tag array isset
  if (isset($_POST['tag'])) {
    //tags from edit page
    $taglist_form = $_POST['tag'];

    //gets all tags for the questionID
    $tag_check_sql = "SELECT * FROM questiontag WHERE questionID = $questionID";
    $tag_check_qry = mysqli_query($dbconnect, $tag_check_sql);
    $tag_check_aa = mysqli_fetch_assoc($tag_check_qry);

    do {
      $tagname = $tag_check_aa["tagID"];
      array_push($taglist_db, $tagname);
    } while ($tag_check_aa = mysqli_fetch_assoc($tag_check_qry));

    //list of items to delete from database
    $delete_list = array_diff($taglist_db, $taglist_form);
    //array of items
    $insert_list = array_diff($taglist_form, $taglist_db);
  }

  // check if any questions in database are the same
  $check_sql = "SELECT * FROM question WHERE qnumber = $qnumber AND levelID = $level and yearID = $year";
  //send to database
  $check_qry = mysqli_query($dbconnect, $check_sql);

  //if question is in database and there are no tags to changes
  if (mysqli_num_rows($check_qry) > 0 && $delete_list == 0 && $insert_list == 0) {
    //send back to db page and duplicate question error
    header("Location:index.php?page=adminpanel&tab=questiondb&status=duplicateq");
  } else {
    //if user has made any edits, update the question info
    if (($delete_list > 0 OR $insert_list > 0) OR mysqli_num_rows($check_qry) == 0){
      //info about old question from db
      //get year from db
      $originalq_sql = "SELECT *, year.name AS year, level.name AS level FROM question INNER JOIN year ON question.yearid = year.yearID INNER JOIN level ON question.levelID = level.levelID WHERE questionID = $questionID";
      $originalq_qry = mysqli_query($dbconnect, $originalq_sql);
      $originalq_aa = mysqli_fetch_assoc($originalq_qry);
      $original_filename = $originalq_aa['filename'];

      //get year from db
      $year_sql = "SELECT name FROM year WHERE yearID = $year";
      $year_qry = mysqli_query($dbconnect, $year_sql);
      $year_aa = mysqli_fetch_assoc($year_qry);
      $file_year = $year_aa['name'];

      //get level from db
      $level_sql = "SELECT name FROM level WHERE levelID = $level";
      $level_qry = mysqli_query($dbconnect, $level_sql);
      $level_aa = mysqli_fetch_assoc($level_qry);
      $file_level = $level_aa['name'];

      // gets file extenetion
      $path_parts = pathinfo($original_filename);
      $extension = $path_parts['extension'];

      //creates new file name
      $new_filename = $file_year . "-" . $file_level . "-" . $qnumber . "." . $extension;
      $new_filename_ext = "questions/" . $new_filename;
      //renames file in folder
      rename("questions/$original_filename", "$new_filename_ext");

      //update questiondb sql
      $update_sql = "UPDATE question
                     SET qnumber = '$qnumber', answer = '$answer', levelID = '$level', yearID = '$year', filename = '$new_filename'
                     WHERE questionID = $questionID";

      //send to database
      $update_qry = mysqli_query($dbconnect, $update_sql);

      //update tags
      if (isset($_POST['tag'])) {
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
        $delete_tag_sql = "DELETE FROM questiontag WHERE questionID=$questionID and tagID = $delete_tagID";
        // sends sql query to data base
        $delete_tag_qry = mysqli_query($dbconnect, $delete_tag_sql);
      }

      //
      header("Location:index.php?page=adminpanel&tab=questiondb&status=editsuccess");
    } else {
      header("Location:index.php?page=adminpanel&tab=questiondb&status=duplicateq");
    }
  }










 ?>
