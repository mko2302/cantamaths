<?php
  // all status messages
  if(isset($_GET['status'])) {
    $status = $_GET['status'];

    //generic error messages
    if ($status == "duplicateq") {
       echo "<div class='alert alert-danger' role='alert'>
               Question already exists in database!
            </div>";
    }
    if ($status == "error") {
      echo "<div class='alert alert-danger' role='alert'>
               Error has occured
           </div>";
    }

    //add question status messages
    // check status to see if there was an error
    if ($status == "nonimage") {
      echo "<div class='alert alert-warning' role='alert'>
              File uploaded is not an image!
           </div>";
    }
    if ($status == "duplicateimage") {
       echo "<div class='alert alert-danger' role='alert'>
                Image already exists!
            </div>";
    }
    if ($status == "addsuccess") {
      echo "<div class='alert alert-success' role='alert'>
               New question added!
           </div>";
    }

    // delete question success messages
    if ($status == "deletesuccess") {
      echo "<div class='alert alert-success' role='alert'>
               Question deleted
           </div>";
    }

    // edit question success messages
    if ($status == "editsuccess") {
      echo "<div class='alert alert-success' role='alert'>
               Edit complete
           </div>";
    }
  }

 ?>
