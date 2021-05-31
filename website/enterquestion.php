<?php
  $qnumber = $_POST['qnumber'];
  $answer = $_POST['answer'];
  $year = $_POST['year'];
  $level = $_POST['level'];
  $tags = $_POST['tag'];

  $check_sql = "SELECT * FROM question WHERE qnumber LIKE $qnumber AND yearID LIKE '$year' AND levelID LIKE $level";

  $check_qry = mysqli_query($dbconnect, $check_sql);

    if (mysqli_num_rows($check_qry) > 0){
      header("Location:index.php?page=adminpanel&tab=addquestion&status=duplicate");
    } else {
      $target_dir = "questions/";
      //path of where file is uploaded
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      // holds file extention
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
        // Check if file already exists
        if (file_exists($target_file)) {
          header("Location:index.php?page=adminpanel&tab=addquestion&status=duplicate");
          $uploadOk = 0;
        } else {
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            header("Location:index.php?page=adminpanel&tab=addquestion&status=error");
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              //insert question into database
              $filename = $_FILES["fileToUpload"]["name"];

              $insert_sql = "INSERT INTO question (qnumber, filename, answer, yearID, levelID) VALUES ($qnumber, '$filename', '$answer', $year, $level)";
              // sends sql query to data base
              $insert_qry = mysqli_query($dbconnect, $insert_sql);

              $lastID = mysqli_insert_id($dbconnect);

              foreach ($tags as $tagID){
                $addtag_sql = "INSERT INTO questiontag (questionID, tagID) VALUES ($lastID, $tagID)";

                $addtag_qry = mysqli_query($dbconnect, $addtag_sql);
              }
              header("Location:index.php?page=adminpanel&tab=addquestion&status=success");
            } else {
                header("Location:index.php?page=adminpanel&tab=addquestion&status=error");
            }
          }
        }
      } else {
        $uploadOk = 0;
        header("Location:index.php?page=adminpanel&tab=addquestion&status=nonimage");
      }
    }
?>
