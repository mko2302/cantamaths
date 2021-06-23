<?php session_start();

if(isset($_SESSION['year'])) {
  unset($_SESSION['year']);
}


 ?><div class="col-2">

<?php

  $year_sql = "SELECT * FROM year ORDER BY name desc";
  $year_qry = mysqli_query($dbconnect, $year_sql);
  $year_aa = mysqli_fetch_assoc($year_qry);

  do {

    $name = $year_aa['name'];
    $yearID = $year_aa['yearID'];
    echo "<div id='demo'></div>";
    echo "
      <div class='form-check'>
        <input class='form-check-input' type='checkbox' value='' onclick='loadDoc($yearID)' id='defaultCheck1'>
        <label class='form-check-label' for='defaultCheck1'>
          $name
        </label>
      </div>";

  } while ($year_aa = mysqli_fetch_assoc($year_qry));

?>
</div>

<script>
function loadDoc(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "test.php?yearID="+id, true);
  xhttp.send();
}
</script>






<?php
  session_start();

  if(isset($_SESSION[$filter])) {
    unset($_SESSION[$filter]);
  }

  echo "<div class='col-2'>";

    $filter_sql = "SELECT * FROM $filter ORDER BY name desc";
    $filter_qry = mysqli_query($dbconnect, $year_sql);
    $filter_aa = mysqli_fetch_assoc($year_qry);

    do {

      $name = $filter_aa['name'];
      $filterID = $filter_aa[$year+'ID'];

      echo "<div id='demo'></div>";

      echo "
        <div class='form-check'>
          <input class='form-check-input' type='checkbox' value='' onclick='loadDoc($filterID)' id='defaultCheck1'>
          <label class='form-check-label' for='defaultCheck1'>
            $name
          </label>
        </div>";

    } while ($filter_aa = mysqli_fetch_assoc($filter_qry));
    
  echo "</div>";
?>


<script>
function loadDoc(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "test.php?filterID="+id, true);
  xhttp.send();
}
</script>
