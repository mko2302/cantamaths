<?php
  include("dbconnect.php");

  if (isset($_POST['yearID'])) {
    $yearID = $_POST['yearID'];
  }

  $year_sql= "SELECT * FROM year WHERE yearID = $yearID";
  //send to database
  $year_qry = mysqli_query($dbconnect, $year_sql);
  $year_aa = mysqli_fetch_assoc($year_qry);
  $name = $year_aa['yearname'];

  $yearq_sql = "SELECT * FROM question where yearID = $yearID";
  //send to Database
  $yearq_qry = mysqli_query($dbconnect, $yearq_sql);
  $yearq_num = mysqli_num_rows($yearq_qry);

 ?>

<div class="modal-header">
  <h5 class="modal-title">Are you sure you want to delete "<?php echo"$name";?>?"</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="modal-content">
  <div class="col-11 m-2">
    <p>Deleting will remove the year "<?php echo"$name"; ?>" from <?php echo"$yearq_num";?> questions.</p>
  </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  <?php echo"<a href='index.php?page=deleteyear&yearID=$yearID'>"; ?>
    <button type="button" class="btn btn-danger">Confirm Delete</button>
  </a>
</div>
