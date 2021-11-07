<!-- This page is to add tags, years and levels if needed -->
<!-- users should be able to also add new tags on the add question page-->
<div class="admin-option" id="adminOption">
  <div class="row">
    <div class="col-8">
        <h2>Database Options</h2>
    </div>

    <div class="col-4">
      <?php include("status.php") ?>
    </div>
  </div>

  <div class="row" id="optionRow">
    <!-- Tag options -->
    <div class="col-5 mx-1">
      <div class="row m-3">
          <h3>Tags</h3>
      </div>
      <div class="row" id="tagRow">
        <!-- form to enter new tag -->
        <div class="col-4">
            <form action="index.php?page=adminpanel&tab=entertag" method="post">
              <div class="form-group">
                <label>Add Tag</label>
                <input type="text" class="form-control"  name="tagname" aria-describedby="Enter Tag" placeholder="Enter new tag" required>
              </div>

              <button type="submit" class="btn btn-primary">Add Tag</button>
            </form>

        </div>

        <div id="displaytags_data" class="col-8">

        </div>
      </div>
    </div>

    <script type="text/JavaScript">
       function fetch_tag(tagpage){
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

       fetch_tag();

       $(document).on("click", ".page-tag-clickable", function(){
                var tagpage = $(this).attr("value");
                fetch_tag(tagpage);
             })
    </script>

    <!-- New years of questions -->
    <div class="col-5">
      <div class="row m-3">
        <h3>Compeition Year</h3>
      </div>
      <div class="row" id="yearRow">
        <!-- form to enter new year -->
        <div class="col-4">
            <form action="index.php?page=adminpanel&tab=enteryear" method="post">
              <div class="form-group">
                <label>Add Compeition Year</label>
                <input type="text" class="form-control"  name="yearname" aria-describedby="Enter year" placeholder="Enter new year" required>
              </div>

              <button type="submit" class="btn btn-primary">Add year</button>
            </form>

        </div>

        <div id="displayyear_data" class="col-8">

        </div>
      </div>
    </div>

    <script type="text/JavaScript">
       function fetch_year(yearpage){
          $.ajax({
             url: "displayyear.php",
             method: "POST",
             data: {
                yearpage: yearpage
             },
             success: function(yeardata){
                $("#displayyear_data").html(yeardata);
             }
          });
       }

       fetch_year();

       $(document).on("click", ".page-year-clickable", function(){
                var yearpage = $(this).attr("value");
                fetch_year(yearpage);
             })
    </script>

  </div>
</div>
