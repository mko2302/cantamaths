<?php
  include("dbconnect.php");

  //select all qs from database
  $number_sql = "SELECT * FROM tag";
  $number_qry = mysqli_query($dbconnect, $number_sql);
  $number_of_q = mysqli_num_rows($number_qry);

  //pagination code adapted from https://github.com/simonjsuh/pagination-in-php/blob/master/index.php

  //set number of results displyed per page
  $results_per_page = 10;

  //find number of pages needed to display all questions
  $number_of_pages = ceil($number_of_q/$results_per_page);

  //find number page user is on
  if (!isset($_POST['page'])) {
    $page = 1;
    $_SESSION['tagpage'] = $page;
  } else {
    $page = $_POST['page'];
    $_SESSION['tagpage'] = $page;
  }

  $page_first_result = ($page - 1) * $results_per_page;

  //sql query to get number of questions depending on what page user is on
  $tag_sql = "SELECT * FROM tag LIMIT $page_first_result , $results_per_page";

  $tag_qry = mysqli_query($dbconnect, $tag_sql);
?>

  <table class='table table-striped'>
      <thead>
        <tr>
          <th>Tags</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>

<?php
    // error catching if no results
    if (mysqli_num_rows($tag_qry) == 0) {
      $output .= "<p class='ext-center p-5'>No tags in database</p>";
    } else {
      $tag_aa = mysqli_fetch_assoc($tag_qry);
        do {
            $tagID = $tag_aa['tagID'];
            $name = $tag_aa['tagname'];
            ?>
             <tr>
               <!-- name -->
               <td>
                 <?php echo "$name"; ?>
               </td>
               <!-- delete column -->
               <td>
                 <button type="button" class="btn btn-danger deleteButton" <?php echo"data-id='$tagID'"; ?>>
                   Delete
                 </button>

                 <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
                   <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">


                     </div>
                   </div>
                 </div>

                 <script type='text/javascript'>
                 $(document).ready(function(){

                   //delegate the event using "on" to make ajax function properly
                   $('#tagRow').on('click','.deleteButton',function(e){
                     e.preventDefault();

                       //question id is the one user clicked on
                       var tagID = $(this).data('id');

                       // AJAX request
                       $.ajax({
                           url: 'deletetagmodal.php',
                           type: 'POST',
                           data: {tagID: tagID},
                           success: function(response){
                               // Add response in Modal body
                               $('.modal-content').html(response);

                               // Display Modal
                               $('#deleteModal').modal('show');
                             }
                         });
                     });
                   });
                 </script>

               </td>
              </tr>
            <?php
        } while ($tag_aa = mysqli_fetch_assoc($tag_qry));
      }
?>
      </tbody>
    </table>


<!-- pageination -->
  <nav aria-label="Page navigation mt-5">
      <ul class="pagination justify-content-center">
        <?php
        if($page > 1){
          // make make previous button so to previous page
          $previous = $page - 1;
          echo "<li class='page-item' value='$previous'><span class='page-link'>Previous</span></li>";
        } else {
          // is page is not > 1, disable the button
          echo "<li class='page-item disabled'><span class='page-link'>Previous</span></li>";
        }

        // number pagination
          // for the number of pages
        for($i = 1; $i <= $number_of_pages; $i++ ):
          if ($page == $i) {
            // if the page button is the current page, make it display as active
            echo "<li class='page-item active' value='$i'>
                    <a class='page-link'>$i</a>
                  </li>";
          } else {
            // else just display as normal
            echo "<li class='page-item' value='$i'>
                    <a class='page-link'>$i</a>
                  </li>";
          }
         endfor;

         // next button
          // if current page is >= to the total number of pages
         if ($page >= $number_of_pages) {
           // disable the next button
           echo "<li class='disabled'><span class='page-link'>Next</span></li>";
         } else {
           // otherwise make button go to next page
           $next = $page + 1;
           echo "<li class='page-item' value='$next'><span class='page-link'>Next</span></li>";
         }
         ?>

      </ul>
  </nav>
