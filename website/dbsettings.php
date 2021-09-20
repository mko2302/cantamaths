<!-- This page is to add tags, years and levels if needed -->
<!-- users should be able to also add new tags on the add question page-->
<div class="admin-option" id="adminOption">
  <h2>Database Options</h2><br>

  <div class="row" id="tagRow">

    <div class="col-3">
     <form action="index.php?page=adminpanel&tab=entertag" method="post">
       <div class="form-group">
         <label>Enter New Tag</label>
         <input type="text" class="form-control"  name="tagname" aria-describedby="Enter Tag" placeholder="Enter new tag" required>
       </div>

       <button type="submit" class="btn btn-primary">Add Tag</button>
     </form>
     <?php include("status.php") ?>
    </div>

    <div id="displaytags_data" class="col-3">

    </div>

    <script type="text/JavaScript">
       function fetch_data(tagpage){
          $.ajax({
             url: "displaytags.php",
             method: "POST",
             data: {
                tagpage: tagpage
             },
             success: function(tagdata){
                $("#displaytags_data").html(tagdata);
             }
          });
       }

       fetch_data();

       $(document).on("click", ".page-item", function(){
                var tagpage = $(this).attr("value");
                fetch_data(tagpage);
             })
    </script>

  </div>
</div>
