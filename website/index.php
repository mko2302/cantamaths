<?php session_start();

// Includes database connection code
include("dbconnect.php"); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

<!-- Bootstrap CSS and custom stylesheet -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="custom.scss">

<!-- Ajax/Jquery and popper js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Cantamaths</title>
  </head>
  <body>
<!-- Includes navbar and breadcrumbs code -->
      <?php include("navbar.php");
// All pages are run through index to prevent rewriting source code
// Page's are received through GET array, and if one is selected then display that page otherwise display home page
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        include("breadcrumbs.php");
        include("$page.php");
      } else {
        include("home.php");
      } ?>
  </body>
</html>
