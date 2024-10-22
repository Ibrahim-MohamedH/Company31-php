<?php
//cofig
require_once "c:xampp/htdocs/company31/app/configDB.php";
require_once "c:xampp/htdocs/company31/app/functions.php";
// UI
require_once '../shared/header.php';
require_once '../shared/navbar.php';
$categoriesQuery = "SELECT * FROM `categories`";
$categories = mysqli_query($con, $categoriesQuery);


$message = '';
$errors = []; // ['Product Title must be at least 4 characters','Product Description must be at least 10 characters']


if (isset($_POST['submit'])) {
  $title =  filterString($_POST['title']);
  $description =  filterString($_POST['description']);
  $price =  $_POST['price'];
  $category_id =  $_POST['category_id'];

  if (stringValidation($title, 4)) {
    $errors[] = 'Product Title must be at least 4 characters';
  }
  if (stringValidation($description, 10)) {
    $errors[] = 'Product Description must be at least 10 characters';
  }

  // Upload Image
  $realName = $_FILES['image']['name'];
  $imgSize = $_FILES['image']['size'];
  $imgName = "company31.com_Product_" . rand(0, 10000) . time() . $realName;
  $tmpName = $_FILES['image']['tmp_name'];
  $location = 'uploads/' . $imgName;

  if (imageValidation($realName, $imgSize, 3)) {
    $errors[] = "Image is Required and must be less than 3MB";
  }


  if (empty($errors)) {
    move_uploaded_file($tmpName, $location);
    $insertQuery = "INSERT INTO `products` VALUES (NULL, '$title', '$description', $price, $category_id, '$imgName')";
    $insert = mysqli_query($con, $insertQuery);
    if ($insert) {
      $message = 'Products added successfully';
    }
  }
}
?>


<div class="container col-6 pt-5">
  <h2 class="text-center  text-light">Add new product</h2>
  <div class="card border-0">
    <div class="card-body bg-dark text-light">
      <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
          <ul>
            <?php foreach ($errors as $error) : ?>
              <li> <?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      <?php if (!empty($message)) : ?>
        <div class="alert alert-success">
          <p class="fs-4 mb-0"><?= $message ?></p>
        </div>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="form-group col-md-6 col-12 mb-2">
            <label for="title" class="form-label">
              Title
            </label>
            <input type="text" class="form-control" id="title" name="title">
          </div>
          <div class="form-group col-md-6 col-12 mb-2">
            <label for="description" class="form-label">
              Description
            </label>
            <textarea rows="1" class="form-control" id="description" name="description"></textarea>
          </div>
          <div class="form-group col-md-6 col-12 mb-2">
            <label for="price" class="form-label">
              Price
            </label>
            <input type="number" class="form-control" id="price" name="price">
          </div>
          <div class="form-group col-md-6 col-12 mb-2">
            <label for="category_id" class="form-label">
              Category
            </label>
            <select id="category_id" name="category_id" class="form-select">
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['category'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group col-12 mb-2">
            <label for="image" class="form-label">
              Product Image
            </label>
            <input type="file" class="form-control" id="image" name="image">
          </div>
          <div class="text-center">
            <button class="btn btn-primary" name="submit">Add Product</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>






<?php
require_once '../shared/footer.php';
?>