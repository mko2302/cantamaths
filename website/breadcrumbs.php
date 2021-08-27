<?php
  if ($page == "fifty-fifty") {
?>
<ol class="breadcrumb bg-breadcrumbs">
  <li class="breadcrumb-item"><a class="breadcrumb-highlight" href="index.php">Home</a></li>
  <li class="breadcrumb-item breadcrumb-highlight">Custom/Past Paper</li>
  <li class="breadcrumb-item breadcrumb-disabled" >Select</li>
  <li class="breadcrumb-item breadcrumb-disabled">Print</li>
</ol>
<?php
} else if ($page == "custom" OR $page == "past-papers") {
?>
<ol class="breadcrumb bg-breadcrumbs">
  <li class="breadcrumb-item"><a class="breadcrumb-highlight" href="index.php">Home</a></li>
  <li class="breadcrumb-item"><a class="breadcrumb-highlight" href="index.php?page=fifty-fifty">Custom/Past Paper</a></li>
  <li class="breadcrumb-item breadcrumb-highlight" >Select</li>
  <li class="breadcrumb-item breadcrumb-disabled">Print</li>
</ol>
<?php } ?>
