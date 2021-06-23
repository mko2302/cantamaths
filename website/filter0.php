<?php session_start();

if(isset($_SESSION['levelID'])) {
  unset($_SESSION['levelID']);
}
if(isset($_SESSION['yearID'])) {
  unset($_SESSION['yearID']);
}


echo "<div class='col-2'>";


  $a = 0;
  do {
    if ($a == 0) {
      $filter = "year";
      $nameID = "yearID";
    } else {
      $filter = "level";
      $nameID = "levelID";
    }


    $filter_sql = "SELECT * FROM $filter ORDER BY name desc";
    $filter_qry = mysqli_query($dbconnect, $filter_sql);
    $filter_aa = mysqli_fetch_assoc($filter_qry);

    do {
      $name = $filter_aa['name'];
      $filterID = $filter_aa[$nameID];


      echo "<div id='demo'></div>"; ?>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" onclick="loadDoc(<?php echo "'$nameID'"; ?>, <?php echo $filterID; ?>)" id="defaultCheck1">
        <label class="form-check-label" for="defaultCheck1">
          <?php echo "$name $nameID"; ?>
        </label>
      </div>
    <?php } while ($filter_aa = mysqli_fetch_assoc($filter_qry)); ?>


    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" onclick="loadDoc(<?php echo "'$nameID'"; ?>, <?php echo "'all'"; ?>)" id="defaultCheck1">
      <label class="form-check-label" for="defaultCheck1">
        <?php echo "all $nameID"; ?>
      </label>
    </div>


    <?php $a += 1;
  } while ($a <= 1);

echo "</div>"; ?>


<script>
function loadDoc(filter, id) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "print.php?" + filter + "=" + id, true);
  xhttp.send();
}
</script>
