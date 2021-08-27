<?php
  //includes database connection code
  include("dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="custom.scss">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>cantamathss</title>
  </head>
  <body>

    <!-- includes navbar code -->
    <?php include("navbar.php");

    // if user clicks on a link
    if (isset($_GET['page'])) {
      // opens page user clicked on
      $page = $_GET['page'];
      include("breadcrumbs.php");
      include("$page.php");
      // else goes to home page
    } else {
      include("home.php");
    } ?>


     <!-- Optional JavaScript -->
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

     <!-- Ajax is used so that the page does not have to be reloaded each time a new filter is selected -->

  </body>
</html>
