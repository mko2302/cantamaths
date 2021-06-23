<?php session_start();


# Connects to the database
$dbconnect = mysqli_connect("localhost", "root", "", "cantamathdb");

# Recieves information sent through by ajax in the GET array
$id = $_GET['id'];
$filter = $_GET['filter'];


# If the checkbox selected was all then it unsets the session of the filter that it is assigned to
if ($id == 'all') {
  unset($_SESSION[$filter]);
} else {
# If the checkbox selected was not all, then check if there the filter is set (any active filters)
  if (isset($_SESSION[$filter])) {
# If there are active filters, check if the the id of the checkbox is already in the filter array
    if (in_array($id,$_SESSION[$filter])) {
# If it is remove it from filter (note: This would be if checkbox is being unchecked)
      if (($key = array_search($id, $_SESSION[$filter])) !== FALSE) {
        unset($_SESSION[$filter][$key]);
      }
# Otherwise add id of checkbox to its filter
    } else {
      array_push($_SESSION[$filter],$id);
    }
# If the filter is unset then set it and add the id of the checkbox to the array
  } else {
  $_SESSION[$filter] = [$id];
  }

# If a filter is empty then unset the array
  if (empty($_SESSION[$filter])) {
    unset($_SESSION[$filter]);
  }
}


include("Display.php") ?>
