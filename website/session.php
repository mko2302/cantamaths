<?php 
# If the checkbox selected was all then it unsets the session of the filter that it is assigned to
# If the checkbox selected was not all, then check if there the filter is set (any active filters)
  if (isset($_SESSION[$array])) {
# If there are active filters, check if the the id of the checkbox is already in the filter array
    if (in_array($id,$_SESSION[$array])) {
# If it is remove it from filter (note: This would be if checkbox is being unchecked)
      if (($key = array_search($id, $_SESSION[$array])) !== FALSE) {
        unset($_SESSION[$array][$key]);
      }
# Otherwise add id of checkbox to its filter
    } else {
      array_push($_SESSION[$array],$id);
    }
# If the filter is unset then set it and add the id of the checkbox to the array
  } else {
  $_SESSION[$array] = [$id];
  }

# If a filter is empty then unset the array
  if (empty($_SESSION[$array])) {
    unset($_SESSION[$array]);
  } ?>
