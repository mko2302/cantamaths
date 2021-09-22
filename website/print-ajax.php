<?php
  $yearID = $_GET['yearID'];
  $levelID = $_GET['levelID'];


    $dbconnect = mysqli_connect("localhost", "root", "", "cantamathsdb");
    $selected_sql = "SELECT filename, answer FROM question WHERE yearID = $yearID and levelID = $levelID";
    $selected_qry = mysqli_query($dbconnect, $selected_sql);
    while($selected_aa = mysqli_fetch_assoc($selected_qry)) {
      $filename = $selected_aa['filename'];
      $image = '<img src="questions/"$filename"" class="img-fluid" style="height: 135px;">';

echo '
        <tr>
          <td><img src="questions/'.$filename.'" class="img-fluid" style="height: 135px;"></td>
        </tr>';
    }



?>
