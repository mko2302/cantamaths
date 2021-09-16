<?php
  $qnumber = $_POST['qnumber'];
  $answer = $_POST['answer'];
  $year = $_POST['year'];
  $level = $_POST['level'];
  // error catching if no tags are entered
  if (isset($_POST['tag'])) {
    $tags = $_POST['tag'];
  }

  $check_sql = "SELECT * FROM question WHERE qnumber LIKE $qnumber AND yearID LIKE '$year' AND levelID LIKE $level";

  $check_qry = mysqli_query($dbconnect, $check_sql);

  clearstatcache();

    if (mysqli_num_rows($check_qry) > 0){
      header("Location:index.php?page=adminpanel&tab=addquestion&status=duplicateq");
    } else {
      $target_dir = "questions/";
      //path of where file is uploaded
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["tmp_name"]);
      // set upload Ok
      $uploadOk = 1;
      // holds file extention
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
          $uploadOk = 0;
          header("Location:index.php?page=adminpanel&tab=addquestion&status=nonimage");
        }

      // Check if file already exists
      if (file_exists($target_file)) {
        $uploadOk = 0;
        header("Location:index.php?page=adminpanel&tab=addquestion&status=duplicateimage");
      }

      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 7000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }

      // change filename

      $year_sql = "SELECT * FROM year WHERE yearID = $year";
      $year_qry = mysqli_query($dbconnect, $year_sql);
      $year_aa = mysqli_fetch_assoc($year_qry);
      $file_year = $year_aa['yearname'];

      $level_sql = "SELECT * FROM level WHERE levelID = $level";
      $level_qry = mysqli_query($dbconnect, $level_sql);
      $level_aa = mysqli_fetch_assoc($level_qry);
      $file_level = $level_aa['levelname'];

      // gets file extenetion
      $file_path = pathinfo($_FILES["fileToUpload"]["name"]);
      $extension = $file_path['extension'];

      $filename = $file_year . "-" . $file_level . "-" . $qnumber . "." . $extension;
      $new_target_file = $target_dir . $filename;

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        // header("Location:index.php?page=adminpanel&tab=addquestion&status=error");
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $new_target_file)) {
          //insert question into database

          $insert_sql = "INSERT INTO question (qnumber, filename, answer, yearID, levelID) VALUES ($qnumber, '$filename', '$answer', $year, $level)";
          // sends sql query to data base
          $insert_qry = mysqli_query($dbconnect, $insert_sql);

          $lastID = mysqli_insert_id($dbconnect);

          foreach ($tags as $tagID){
            $addtag_sql = "INSERT INTO questiontag (questionID, tagID) VALUES ($lastID, $tagID)";

            $addtag_qry = mysqli_query($dbconnect, $addtag_sql);
          }

          echo "success $filename";

          header("Location:index.php?page=adminpanel&tab=addquestion&status=addsuccess");
        } else {
            header("Location:index.php?page=adminpanel&tab=addquestion&status=error");
        }
        }
      }
?>
