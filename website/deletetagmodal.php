<?php
  include("dbconnect.php");

  if (isset($_POST['tagID'])) {
    $tagID = $_POST['tagID'];
  }

  $tag_sql= "SELECT * FROM tag WHERE tagID = $tagID";
  //send to database
  $tag_qry = mysqli_query($dbconnect, $tag_sql);
  $tag_aa = mysqli_fetch_assoc($tag_qry);
  $name = $tag_aa['tagname'];

 ?>

<div class="modal-header">
  <h5 class="modal-title">Are you sure you want to delete "<?php echo"$name"; ?>"</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  <?php echo"<a href='index.php?page=deletetag&tagID=$tagID'>"; ?>
    <button type="button" class="btn btn-danger">Confirm Delete</button>
  </a>
</div>
