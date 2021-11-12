<!-- This page is to add tags, years and levels if needed -->
<!-- users should be able to also add new tags on the add question page-->
<div class="row">
  <div id="displaytags_data" class="col-3">

  </div>

  <script type="text/JavaScript">
     function fetch_data(page){
        $.ajax({
           url: "displaytags.php",
           method: "POST",
           data: {
              page: page
           },
           success: function(data){
              $("#displaytags_data").html(data);
           }
        });
     }

     fetch_data();

     $(document).on("click", "")

     $(document).on("click", ".page-item", function(){
              var page = $(this).attr("id");
              fetch_data(page);
           })
  </script>

  <div class="col-6">
   <form action="index.php?page=adminpanel&tab=entertag" method="post">
     <div class="form-group">
       <label>Enter New Tag</label>
       <input type="text" class="form-control"  name="tag_name" aria-describedby="Enter Tag" placeholder="Enter new tag">
     </div>

     <button type="submit" class="btn btn-primary">Add Tag</button>
   </form>

  </div>
</div>
