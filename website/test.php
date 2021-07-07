<style>
#checkbox-container{
  margin: 10px 5px;
}

#checkbox-container div{
  margin-bottom: 5px;
}

#checkbox-container button{
  margin-top: 5px;
}

input[type=text] {
  padding: .5em .6em;
  display: inline-block;
  border: 1px solid #ccc;
  box-shadow: inset 0 1px 3px #ddd;
  border-radius: 4px;
}
</style>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <?php $filter = "level";
    $nameID = "levelID";
    $filtername = "levelname"; ?>

    <div class="All_Checkbox">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo "'all'"; ?>)" id="<?php echo "$nameID"; ?>_All">
        <label class="form-check-label">
          <?php echo "All"; ?>
        </label>
      </div>
    </div>

    <div id="checkbox-container">
      <div>
        <label for="option1">Option 1</label>
        <input type="checkbox" id="option1">
      </div>
    </div>
    <div id="checkbox-container">
      <div>
        <label for="option2">Option 2</label>
        <input type="checkbox" id="option2">
      </div>
    </div>
      <div>
        <label for="option3">Option 3</label>
        <input type="checkbox" id="option3">
      </div>
    </div>


  </body>
</html>


<script>
$(document).ready(function(){
$("#<?php echo "$nameID"; ?>_All").click(function(){
  $("#checkbox-container :checkbox").prop("checked",false);
});
});
</script>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>



<div class="All_Checkbox">
  <div class="form-check">
    <input class="form-check-input" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo "'all'"; ?>)" id="<?php echo "$nameID"; ?>_All">
    <label class="form-check-label">
      <?php echo "All"; ?>
    </label>
  </div>
</div>


<div id="<?php echo "$nameID"; ?>_Specific_Checkbox">
<div class="Specific_Checkbox">
  <div class="form-check">
    <input class="form-check-input" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo $filterID; ?>)" id="<?php echo "$nameID"."_"."$filterID"; ?>">
    <label class="form-check-label">
      <?php echo "level"; ?>
    </label>
  </div>
</div>



<div class="Specific_Checkbox">
  <div class="form-check">
    <input class="form-check-input" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo $filterID; ?>)" id="<?php echo "$nameID"."_"."$filterID"; ?>">
    <label class="form-check-label">
      <?php echo "year"; ?>
    </label>
  </div>
</div>
</div>


  </body>
</html>


<script>
$(document).ready(function(){



  $("#<?php echo "$nameID"; ?>_All").click(function(){
    $("#<?php echo "$nameID"; ?>_All").prop("checked", true);
    $("#<?php echo "$nameID"; ?>_Specific_Checkbox :checkbox").prop("checked", false);
  });
});
</script>
