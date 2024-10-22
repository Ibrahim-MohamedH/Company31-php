<?php
//cofig
require_once "c:xampp/htdocs/company31/app/configDB.php";
require_once "c:xampp/htdocs/company31/app/functions.php";

// UI
require_once '../shared/header.php';
require_once '../shared/navbar.php';

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $deleteQuery = "DELETE FROM `products` where id = $id";
  $delete = mysqli_query($con, $deleteQuery);
  if ($delete) {
    path('products/list.php');
  }
}

$search = '';
$selectQuery = 'SELECT * FROM `productswithcategories`';
if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $selectQuery = "SELECT * FROM `productswithcategories` where title like '%$search%' or `description` like '%$search%'";
}
$select = mysqli_query($con, $selectQuery);
$numOfRows = mysqli_num_rows($select);
?>

<div class="container col-6 pt-5">
  <h2 class="text-center text-light">List All Products</h2>
  <div class="card border-0">
    <div class="card-body bg-dark text-light">
      <form>
        <div class="input-group">
          <input placeholder="Search" value="<?= $search ?>" type="text" name="search" class="form-control form-control-lg">
          <button class="btn btn-info">Search</button>
          <?php if (!empty($search)): ?>
            <a href="<?= URL('products/list.php') ?>" class="btn btn-secondary">Cancel</a>
          <?php endif; ?>
        </div>
      </form>
      <table class="table table-dark">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($numOfRows > 0): ?>
            <?php foreach ($select as $index => $product): ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $product['title'] ?></td>
                <td><?= $product['description'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><a class="text-reset" href="category_products.php?category_id=<?= $product['cat_id'] ?>&category=<?= $product['category'] ?>"><?= $product['category'] ?></a></td>
                <td>
                  <a href="edit.php?edit=<?= $product['id'] ?>" class="btn btn-warning">Edit</a>
                  <?php if ($_SESSION['employee']['role'] == 1 || $_SESSION['employee']['role'] == 2): ?>
                    <a href="?delete=<?= $product['id'] ?>" class="btn btn-danger">Delete</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center">no data to show</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>










<?php
require_once '../shared/footer.php';
?>