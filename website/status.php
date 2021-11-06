<?php
  // all status messages
  if(isset($_GET['status'])) {
    $status = $_GET['status'];

    //generic error messages
    if ($status == "error") {
      $message = "Error has occured";
      $colour = "danger";
    }

    if ($status == "duplicateq") {
       $message = "Question already exists in database!";
       $colour = "danger";
    }

    //LOG IN
    if ($status == "loginerror") {
       $message = "Incorrect username or password!";
       $colour = "danger";
    }


    //ADD QUESTIONS
    // check status to see if there was an error
    if ($status == "nonimage") {
      $message = "File uploaded is not an image!";
      $colour = "danger";
    }
    //dubplicate image in dataase
    if ($status == "duplicateimage") {
      $message = "Image already exists!";
      $colour = "danger";
    }
    //successfully added question to database
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

    //dbsettings db messages
    //TAGS MANAGEMENT
    // add tag success
    if ($status == "tagsuccess") {
      $message = "Tag added!";
      $colour = "success";
    }

    //delete tag success
    if ($status == "tagdeleted") {
      $message = "Tag Deleted!";
      $colour = "success";
    }

    // YEARS MANAGEMENT
    // add tag success
    if ($status == "yearsuccess") {
      $message = "Year added!";
      $colour = "success";
    }

    //delete year success
    if ($status == "yeardeleted") {
      $message = "Year Deleted!";
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
