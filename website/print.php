<?php session_start();

$yearID = $_GET['yearID'];
$levelID = $_GET['levelID'];


# Selects all from table question where each column is the same as the filters
# If the variable set above is blank then it will select all from that column otherwise only selects those that where in the array
$selected_sql = "SELECT filename, answer FROM question WHERE yearID = $yearID and levelID = $levelID";
$selected_qry = mysqli_query($dbconnect, $selected_sql);
$selected_aa = mysqli_fetch_assoc($selected_qry); ?>
