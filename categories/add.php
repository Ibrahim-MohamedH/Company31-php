<?php
//cofig
require_once "c:xampp/htdocs/company31/app/configDB.php";
// UI
require_once '../shared/header.php';
require_once '../shared/navbar.php';
$message = '';
if (isset($_POST['category'])) {
  $category =  $_POST['category'];
  $insertQuery = "INSERT INTO `categories` VALUES (NULL, '$category')";
  $insert = mysqli_query($con, $insertQuery);
  if ($insert) {
    $message = 'Category added successfully';
  }
}
?>


<div class="container col-6 pt-5">
  <h2 class="text-center  text-light">Add new Category</h2>
  <div class="card border-0">
    <div class="card-body bg-dark text-light">
      <?php if (!empty($message)) : ?>
        <div class="alert alert-success">
          <p class="fs-4 mb-0"><?= $message ?></p>
        </div>
      <?php endif; ?>
      <form method="POST">
        <div class="form-group mb-2">
          <label for="category" class="form-label">
            Category
          </label>
          <input type="text" class="form-control" id="category" name="category">
        </div>
        <div class="text-center">
          <button class="btn btn-primary">Add Category</button>
        </div>
      </form>
    </div>
  </div>
</div>






<?php
require_once '../shared/footer.php';
?>