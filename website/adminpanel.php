<!-- admin panel goes here -->

<?php
error_reporting(0);
// check to see if logged in.
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
}


function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);
  if($currect_page == $url){
      echo 'active'; //class name in css
  }
}

?>
<div class="container-fluid">
  <div class="row justify-content-center admin-container">
     <!-- navbar -->
    <div class="col-lg-2 admin-nav">
      <div class="p-2">
        <h1>Dashboard</h1>
      </div>
      <nav class="nav nav-pills flex-column nav-stacked">
        <li class="nav-item admin-nav-item <?php active('index.php?page=adminpanel&tab=adminhome')?>">
          <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=adminhome">Home</a>
        </li>
        <li class="nav-item admin-nav-item <?php active('index.php?page=adminpanel&tab=addquestion')?>">
          <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=addquestion">Add Questions</a>
        </li>
        <li class="nav-item admin-nav-item <?php active('index.php?page=adminpanel&tab=questiondb')?>">
          <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=questiondb">Question Database</a>
        </li>
        <li class="nav-item admin-nav-item <?php active('index.php?page=adminpanel&tab=dbsettings')?>">
          <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=dbsettings">Database Options</a>
        </li>
        <li class="nav-item admin-nav-item <?php active('index.php?page=adminpanel&tab=users')?>">
          <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=users"=>Users</a>
        </li>
        <li class="nav-item admin-nav-item">
          <a class="nav-link admin-tab" href="logout.php">Log Out</a>
        </li>
      </nav>
    </div>

  <!-- loads tab user clicks on -->
   <div class="col-lg-10 admin-content px-4 py-2 ">
     <?php
     if (isset($_GET['tab'])) {
     //  opens page user clicked on
      $tab = $_GET['tab'];
       include("$tab.php");
     //  else goes to home page
     } else {
       header("Location: index.php?page=adminpanel&tab=adminhome");
     }
     ?>
   </div>
  </div>

</div>
