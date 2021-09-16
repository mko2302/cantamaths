<?php if(isset($_SESSION['Q_ID'])) {
  unset($_SESSION['Q_ID']);
}
if(isset($_SESSION['selected-yearID'])) {
  unset($_SESSION['selected-yearID']);
}
if(isset($_SESSION['selected-levelID'])) {
   unset($_SESSION['selected-levelID']);
} ?>

<div class="page-fill center-x">
  <div class="flex-row area-fill page-resize px-2 px-sm-4 px-lg-5 py-2 py-sm-3 py-lg-4">
    <div class="col-6 pr-2 pr-sm-3 pr-lg-4">
      <a class="btn btn-light border-general area-fill center" href="index.php?page=select-index&select=pastpapers" role="button"><span class="option-center-text p-2">Past Papers</span></a>
    </div>
    <div class="col-6 pl-2 pl-sm-3 pl-lg-4">
      <a class="btn btn-light border-general area-fill center" href="index.php?page=select-index&select=custom" role="button"><span class="option-center-text p-2">Custom</span></a>
    </div>
  </div>
</div>
