<?php
  // all status messages
  if(isset($_GET['status'])) {
    $status = $_GET['status'];

    //generic error messages
    if ($status == "duplicateq") {
       $message = "Question already exists in database!";
       $colour = "danger";
    }
    if ($status == "error") {
      $message = "Error has occured";
      $colour = "danger";
    }

    //add question status messages
    // check status to see if there was an error
    if ($status == "nonimage") {
      $message = "File uploaded is not an image!";
      $colour = "danger";
    }
    if ($status == "duplicateimage") {
      $message = "Image already exists!";
      $colour = "danger";
    }
    if ($status == "addsuccess") {
      $message = "Question added to database!";
      $colour = "success";
    }

    // delete question success messages
    if ($status == "deletesuccess") {
      $message = "Question deleted from database!";
      $colour = "success";
    }

    // edit question success messages
    if ($status == "editsuccess") {
      $message = "Edit complete!";
      $colour = "success";
    }

    echo"
    <div class='alert alert-$colour my-1 alert-dismissible fade show' role='alert'>
      <button type='button' class='close' aria='aria-hidden-true' aria-label='Close'></button>
      $message
    </div>
    ";
  }

 ?>
