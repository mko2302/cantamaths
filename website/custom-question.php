<?php $dbconnect = mysqli_connect("localhost", "root", "", "cantamathdb");

# Recieves information sent through by ajax in the GET array
$id = $_GET['id'];
$array = $_GET['filter'];
include('session.php');

include('custom-question-display.php'); ?>
