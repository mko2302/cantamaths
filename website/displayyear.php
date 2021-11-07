<?php
  include("dbconnect.php");

  //select all qs from database
  $number_sql = "SELECT * FROM year";
  $number_qry = mysqli_query($dbconnect, $number_sql);
  $number_of_q = mysqli_num_rows($number_qry);

  //pagination code adapted from https://github.com/simonjsuh/pagination-in-php/blob/master/index.php

  //set number of results displyed per page
  $results_per_page = 7;

  //find number of pages needed to display all questions
  $number_of_pages = ceil($number_of_q/$results_per_page);

  //find number page user is on
  if (!isset($_POST['yearpage'])) {
    $year_page = 1;
  } else {
    $year_page = $_POST['yearpage'];
  }

  $year_page_first_result = ($year_page - 1) * $results_per_page;

  //sql query to get number of questions depending on what page user is on
  $year_sql = "SELECT * FROM year ORDER BY yearname DESC LIMIT  $year_page_first_result , $results_per_page ";

  $year_qry = mysqli_query($dbconnect, $year_sql);
?>

  <!-- bootstrap table -->
  <table class='table table-striped'>
      <thead>
        <tr>
          <th>Year</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>

<?php
    // error catching if no results
    if (mysqli_num_rows($year_qry) == 0) {
      $output .= "<p class='ext-center p-5'>No years in database</p>";
    } else {
      // put results in assosciative array
      $year_aa = mysqli_fetch_assoc($year_qry);
      // for each row in aa
        do {
          // define variables
            $yearID = $year_aa['yearID'];
            $name = $year_aa['yearname'];
            ?>
             <tr>
               <!-- name -->
               <td>
                 <?php echo "$name"; ?>
               </td>
               <!-- delete column -->
               <td>
                 <button type="button" class="btn btn-danger" id="deleteYearButton" <?php echo"data-id='$yearID'"; ?>>
                   Delete
                 </button>

                 <!-- modal shell -->
                 <div class="modal fade" id="deleteYearModal" tabindex="-1" role="dialog">
                   <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">

                     </div>
                   </div>
                 </div>

                 <script type='text/javascript'>
                 $(document).ready(function(){

                   //delegate the event using "on" to make ajax function properly
                   $('#yearRow').on('click','#deleteYearButton',function(e){
                     e.preventDefault();

                       //question id is the one user clicked on
                       var yearID = $(this).data('id');

                       // AJAX request
                       $.ajax({
                           url: 'deleteyearmodal.php',
                           type: 'POST',
                           data: {yearID: yearID},
                           success: function(response){
                               // Add response in Modal body
                               $('.modal-content').html(response);

                               // Display Modal
                               $('#deleteYearModal').modal('show');
                             }
                         });
                     });
                   });
                 </script>

               </td>
              </tr>
            <?php
        } while ($year_aa = mysqli_fetch_assoc($year_qry));
      }
?>
      </tbody>
    </table>


<!-- pageination -->
<nav aria-label="Page navigation mt-5">
    <ul class="pagination justify-content-center my-1">
      <?php
      if($year_page > 1){
        // make make previous button so to previous page
        $previous = $year_page - 1;
        echo "<li class='page-item page-year-clickable first-child' value='$previous'><span class='page-link'>Previous</span></li>";
      } else {
        // is page is not > 1, disable the button
        echo "<li class='page-item disabled first-child'><span class='page-link'>Previous</span></li>";
      }

      // number pagination
        // for the number of pages
      for($i = 1; $i <= $number_of_pages; $i++ ):
        if ($year_page == $i) {
          // if the page button is the current page, make it display as active
          echo "<li class='page-year-clickable page-item active' value='$i'>
                  <a class='page-link page-active'>$i</a>
                </li>";
        } else {
          // else just display as normal
          echo "<li class='page-year-clickable page-item' value='$i'>
                  <a class='page-link'>$i</a>
                </li>";
        }
       endfor;

       // next button
        // if current page is >= to the total number of pages
       if ($year_page == $number_of_pages) {
         // disable the next button
         echo "<li class='page-item disabled last-child'><span class='page-link'>Next</span></li>";
       } else {
         // otherwise make button go to next page
         $next = $year_page + 1;
         echo "<li class='page-item page-year-clickable last-child' value='$next'><span class='page-link'>Next</span></li>";
       }
       ?>

    </ul>
</nav>
