<div class="row">
  <div class"col-3">
    <?php include("custom-filter-checkboxes.php") ?>
  </div>

  <div class="col-9" id="displaydb_data">
    <?php include("questiondb.php") ?>
  </div>
</div>

<script type="text/javascript">
function fetch_data(page){
   $.ajax({
      url: "questiondb.php",
      method: "POST",
      data: {
         page: page
      },
      success: function(data){
         $("#displaydb_data").html(data);
      }
   });
}

$(document).on("click", ".page-item", function(){
         var page = $(this).attr("id");
         fetch_data(page);
      })
      
</script>
