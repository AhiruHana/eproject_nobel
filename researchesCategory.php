<!DOCTYPE html>
<html lang="en">

<?php
include_once 'layout/head.php';
include_once 'controller/researchCategoryController.php';

?>
<!--  -->
<?php
include_once 'layout/header.php'
?>
<main class="container my-5">
  <h2><?php  echo $category['name'] ?? "All The Nobel Prize"?></h2>
  <div class="row mb-5">
    <?php
      renderResearchByCategory()
    ?>
  </div>
  <?php
    renderTicker()
  ?>
</main>
<?php
include_once 'layout/footer.php'
?>
</body>

</html>