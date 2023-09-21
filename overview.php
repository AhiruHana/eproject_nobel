<!DOCTYPE html>
<html lang="en">

<?php
include_once 'layout/head.php';
include_once 'controller/overviewController.php';
?>
<!--  -->
<?php
include_once 'layout/header.php'
?>
<div class="container my-5">
  <div style="width:22%"></div>
  <div style="width:78%;">
    <h2>Overview</h2>
  </div>
  <div class="row mt-5">
    <div class="sitemap">
      <ul class="my-5 px-1">
        <?php
        renderSitemap();
        ?>
      </ul>
    </div>
    <div class="bio">
      <?php
      renderOverview()
      ?>
    </div>
  </div>
  <?php
  renderTicker()
  ?>
</div>
<?php
include_once 'layout/footer.php'
?>
</body>

</html>