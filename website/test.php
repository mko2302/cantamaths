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
    <input type="text" placeholder="Type something here" />

    <div id="checkbox-container">
      <div>
        <label for="option1">Option 1</label>
        <input type="checkbox" id="option1">
      </div>
      <div>
        <label for="option2">Option 2</label>
        <input type="checkbox" id="option2">
      </div>
      <div>
        <label for="option3">Option 3</label>
        <input type="checkbox" id="option3">
      </div>
      <button>Check All</button>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>


<script>
var checkboxtest = JSON.parse(localStorage.getItem('checkboxtest')) || {},
    $checkboxes = $("#checkbox-container :checkbox");

$checkboxes.on("change", function(){
  $checkboxes.each(function(){
    checkboxtest[this.id] = this.checked;
  });

  localStorage.setItem("checkboxtest", JSON.stringify(checkboxtest));
});

// On page load
$.each(checkboxtest, function(key, value) {
  $("#" + key).prop('checked', value);
});
</script>
