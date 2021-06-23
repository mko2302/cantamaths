<script>
$(document).ready(function(){
  $('input[id="check"]').click(function(){
    if($(this).prop("checked") == true){
      $('input[id="uncheck"]').prop("checked", false);
    }
  });
  $('input[id="uncheck"]').click(function(){
    if($(this).prop("checked") == true){
      $('input[id="check"]').prop("checked", false);
    }
  });
});
</script>

</head>
<body>
    <p><input type="checkbox" id="myCheck"> Are you sure?</p>
    <input type="checkbox" class="check" id="check">Yes</input>
    <input type="checkbox" class="uncheck" id="uncheck">No</input>
	<p><strong>Note:</strong> Click the buttons to check or uncheck checkbox.</p>
</body>
