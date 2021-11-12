<?php
  $qnumber = $_POST['qnumber'];
  $answer = $_POST['answer'];
  $year = $_POST['year'];
  $level = $_POST['level'];
  // error catching if no tags are entered
  if (isset($_POST['tag'])) {
    $tags = $_POST['tag'];
  }

  //sql query to check for a question with the same details
  $check_sql = "SELECT * FROM question WHERE qnumber LIKE $qnumber AND yearID LIKE '$year' AND levelID LIKE $level";
  //send query to database
  $check_qry = mysqli_query($dbconnect, $check_sql);

    if (mysqli_num_rows($check_qry) > 0){
      // if the question exists in the database (more than 1 row)
      //send user back to add quesiton, with the error duplicate question
      header("Location:index.php?page=adminpanel&tab=addquestion&status=duplicateq");
    } else {
      // variable for directory where images are held.
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
        // cancel upload of image and then send user back with error
          $uploadOk = 0;
          header("Location:index.php?page=adminpanel&tab=addquestion&status=nonimage");
        }

      // Check if file already exists
      if (file_exists($target_file)) {
        //if the file exists cancel file upload and send user back with error
        $uploadOk = 0;
        header("Location:index.php?page=adminpanel&tab=addquestion&status=duplicateimage");
      }

      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 10000000) {
        //if the image is too large, cancel upload and sen user back with error
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        header("Location:index.php?page=adminpanel&tab=addquestion&status=largefile");
      }

      // change filename

      //select year from table
      $year_sql = "SELECT * FROM year WHERE yearID = $year";
      $year_qry = mysqli_query($dbconnect, $year_sql);
      $year_aa = mysqli_fetch_assoc($year_qry);
      //set file_year variable of the year sent from the form
      $file_year = $year_aa['yearname'];

      //select level from table
      $level_sql = "SELECT * FROM level WHERE levelID = $level";
      $level_qry = mysqli_query($dbconnect, $level_sql);
      $level_aa = mysqli_fetch_assoc($level_qry);
      //set file_level variable of the name of year level sent from form
      $file_level = $level_aa['levelname'];

      // gets file extenetion
      $file_path = pathinfo($_FILES["fileToUpload"]["name"]);
      $extension = $file_path['extension'];

      //$filename variable is the new file name.
      $filename = $file_year . "-" . $file_level . "-" . $qnumber . "." . $extension;
      //
      $new_target_file = $target_dir . $filename;

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        //if any errors caused uploadOk = 0
        //send user back with error
        header("Location:index.php?page=adminpanel&tab=addquestion&status=error");
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $new_target_file)) {
          //insert question into database
          $insert_sql = "INSERT INTO question (qnumber, filename, answer, yearID, levelID) VALUES ($qnumber, '$filename', '$answer', $year, $level)";
          // sends sql query to data base
          $insert_qry = mysqli_query($dbconnect, $insert_sql);
          //get the questionID of the quetion just inserted
          $lastID = mysqli_insert_id($dbconnect);

          // for each tag in the tag array
          foreach ($tags as $tagID){
            //insert the question and tag into the junction table
            $addtag_sql = "INSERT INTO questiontag (questionID, tagID) VALUES ($lastID, $tagID)";
            //sends query to database
            $addtag_qry = mysqli_query($dbconnect, $addtag_sql);
          }
          //send user back to add question page with success alerts
          header("Location:index.php?page=adminpanel&tab=addquestion&status=addsuccess");
        } else {
            //if any other errors occur, send user back to add question page.
            header("Location:index.php?page=adminpanel&tab=addquestion&status=error");
        }
        }
      }
?>
