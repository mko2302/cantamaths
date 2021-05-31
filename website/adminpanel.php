<!-- admin panel goes here -->

<?php
// check to see if logged in.
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
}
 ?>

<!-- change active tab on click -->
 <script type="text/javascript">
   $(document).ready(function() {
   $('.admin-tab').click(function() {
       $('.admin-tab').removeClass('active');
       $(this).closest('.admin-tab').addClass('active')
   });
  });
 </script>

 <div class="my-4 row justify-content-center">
   <div class="col-xl-2 m-2">
     <nav class="nav nav-pills flex-column nav-stacked">
       <p class="display-4">Dashboard</p>
       <li class="nav-item">
         <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=adminhome">Home</a>
       </li>
       <li class="nav-item">
         <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=addquestion">Add Questions</a>
       </li>
       <li class="nav-item">
         <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=questiondb">Question Database</a>
       </li>
       <li class="nav-item">
         <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=users"=>Users</a>
       </li>
       <li class="nav-item">
         <a class="nav-link admin-tab" href="logout.php">Log Out</a>
       </li>
     </nav>
   </div>



   <div class="col-xl-8">
       <?php
       if (isset($_GET['tab'])) {
       //  opens page user clicked on
        $tab = $_GET['tab'];
         include("$tab.php");
       //  else goes to home page
       } else {
         include("adminhome.php");
       }
       ?>
   </div>
 </div>
