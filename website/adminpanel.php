<!-- admin panel goes here -->

<?php
// check to see if sesssion is not set.
if (!isset($_SESSION['admin'])) {
  // if not send user to home page
  header("Location: index.php");
}

// find which tab is active and set active class
function active($currect_page){
  // get url of page user is on
  $url_array =  explode('&', $_SERVER['REQUEST_URI']);
  // get which admin tab user is on
  $url = $url_array[1];
  // if the page is in the url
  if($currect_page == $url){
    // echo active class
      echo 'active';
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
        <li class="nav-item admin-nav-item <?php active('tab=adminhome')?>">
          <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=adminhome">Home</a>
        </li>
        <li class="nav-item admin-nav-item <?php active('tab=addquestion')?>">
          <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=addquestion">Add Questions</a>
        </li>
        <li class="nav-item admin-nav-item <?php active('tab=questiondb')?>">
          <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=questiondb">Question Database</a>
        </li>
        <li class="nav-item admin-nav-item <?php active('tab=dbsettings')?>">
          <a class="nav-link admin-tab" href="index.php?page=adminpanel&tab=dbsettings">Database Options</a>
        </li>
        <li class="nav-item admin-nav-item <?php active('tab=users')?>">
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
