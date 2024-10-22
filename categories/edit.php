<?php
//cofig
require_once "c:xampp/htdocs/company31/app/configDB.php";
// UI
require_once '../shared/header.php';
require_once '../shared/navbar.php';
$category = '';
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $selectOneQuery = "SELECT * FROM `categories` WHERE id = $id";
  $selectOne = mysqli_query($con, $selectOneQuery);
  $row = mysqli_fetch_assoc($selectOne);
  $category = $row['category'];
  if (isset($_POST['category'])) {
    $category = $_POST['category'];
    $updateQuery = "UPDATE `categories` SET category = '$category' WHERE id = $id";
    $update = mysqli_query($con, $updateQuery);
    if ($update) {
      path('categories/list.php');
    }
  }
}
?>


<div class="container col-6 pt-5">
  <h2 class="text-center  text-light">Update Category</h2>
  <div class="card border-0">
    <div class="card-body bg-dark text-light">
      <form method="POST">
        <div class="form-group mb-2">
          <label for="category" class="form-label">
            Category
          </label>
          <input type="text" value="<?= $category ?>" class="form-control" id="category" name="category">
        </div>
        <div class="text-center">
          <button class="btn btn-warning">Update Category</button>
        </div>
      </form>
    </div>
  </div>
</div>






<?php
require_once '../shared/footer.php';
?>