<?php
  //include database
  include("dbconnect.php");

  // if tagid has tag id in array
  if (isset($_POST['tagID'])) {
    // define tagid variable
    $tagID = $_POST['tagID'];
  }

  // get tagname where id =
  $tag_sql= "SELECT tagname FROM tag WHERE tagID = $tagID";
  //send to database
  $tag_qry = mysqli_query($dbconnect, $tag_sql);
  // put results in associative array
  $tag_aa = mysqli_fetch_assoc($tag_qry);
  // get name from aa
  $name = $tag_aa['tagname'];

  // find how many question are of the same year
  $tagq_sql = "SELECT * FROM questiontag where tagID = $tagID";
  //send to Database
  $tagq_qry = mysqli_query($dbconnect, $tagq_sql);
  // count rows to count no of questions
  $tagq_num = mysqli_num_rows($tagq_qry);
 ?>

<div class="modal-header">
  <h5 class="modal-title">Are you sure you want to delete "<?php echo"$name"; ?>"</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="modal-content">
  <div class="col-11 m-2">
    <!-- message to user -->
    <p>Deleting will remove the tag "<?php echo"$name"; ?>" from <?php echo"$tagq_num";?> questions.</p>
  </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  <!-- confirm delete button sent get array to delete page -->
  <?php echo"<a href='index.php?page=deletetag&tagID=$tagID'>"; ?>
    <button type="button" class="btn btn-danger">Confirm Delete</button>
  </a>
</div>
