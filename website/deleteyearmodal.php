<?php
  include("dbconnect.php");

// if year is isset
  if (isset($_POST['yearID'])) {
    // year id
    $yearID = $_POST['yearID'];
  }

  //select all questions from
  $year_sql= "SELECT yearname FROM year WHERE yearID = $yearID";
  //send to database
  $year_qry = mysqli_query($dbconnect, $year_sql);
  // put in associative array
  $year_aa = mysqli_fetch_assoc($year_qry);
  //get variable from assosicative array
  $name = $year_aa['yearname'];

  // find how many question are of the same year
  $yearq_sql = "SELECT * FROM question where yearID = $yearID";
  //send to Database
  $yearq_qry = mysqli_query($dbconnect, $yearq_sql);
  // count rows to count no of questions
  $yearq_num = mysqli_num_rows($yearq_qry);

 ?>

<div class="modal-header">
  <h5 class="modal-title">Are you sure you want to delete "<?php echo"$name";?>"?</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="modal-content">
  <div class="col-11 m-2">
    <!-- message to user -->
    <p>Deleting will remove the year "<?php echo"$name"; ?>" from <?php echo"$yearq_num";?> questions.</p>
  </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  <!-- confirm delete button sent get array to delete page -->
  <?php echo"<a href='index.php?page=deleteyear&yearID=$yearID'>"; ?>
    <button type="button" class="btn btn-danger">Confirm Delete</button>
  </a>
</div>
