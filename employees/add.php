<?php
//cofig
require_once "c:xampp/htdocs/company31/app/configDB.php";
require_once "c:xampp/htdocs/company31/app/functions.php";
// UI
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$departmentsQuery = "SELECT * FROM `departments`";
$departments = mysqli_query($con, $departmentsQuery);
$message = '';
$errors = [];
if (isset($_POST['submit'])) {
  $name = filterString($_POST['name']);
  $email = filterString($_POST['email']);
  $password = sha1($_POST['password']);
  $department_id = $_POST['department_id'];
  $address = filterString($_POST['address']);
  $phone = filterString($_POST['phone']);
  $role = $_POST['role'];

  if (stringValidation($name, 4)) {
    $errors[] = "Employee name must be more than 4 characters";
  }
  if (stringValidation($email, 0)) {
    $errors[] = "Employee must enter an email";
  }
  if (stringValidation($address, 0)) {
    $errors[] = "Employee must enter an address";
  }
  if (stringValidation($phone, 11)) {
    $errors[] = "Employee phone number must be more than 10 characters";
  }

  $realName = $_FILES['image']['name'];
  $imgSize = $_FILES['image']['size'];
  $imgName = "Company31.com_" . rand(0, 10000) . "_" . time() . "_" . $realName;
  $tmpName = $_FILES['image']['tmp_name'];
  $location = 'uploads/' . $imgName;

  if (imageValidation($realName, $imgSize, 3)) {
    $errors[] = "Image is required and must be less than 3MB";
  }

  if (empty($errors)) {
    move_uploaded_file($tmpName, $location);
    $insertQuery = "INSERT INTO `employees` VALUES (NULL, '$name','$email','$password','$department_id','$address', '$phone', '$imgName', $role)";
    $insert = mysqli_query($con, $insertQuery);
    if ($insert) {
      $message = 'Employee added successfully';
    }
  }
}
?>


<div class="container col-6 pt-5">
  <h2 class="text-center  text-light">Add New Employee</h2>
  <div class="card border-0">
    <div class="card-body bg-dark text-light">
      <?php if (!empty($message)) : ?>
        <div class="alert alert-success">
          <p class="fs-4 mb-0"><?= $message ?></p>
        </div>
      <?php endif; ?>
      <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
          <ul>
            <?php foreach ($errors as $error): ?>
              <li><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      <form method="POST" enctype='multipart/form-data'>
        <div class="row">
          <div class="form-group col-md-6 mb-2">
            <label for="name" class="form-label">
              Name
            </label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="email" class="form-label">
              Email
            </label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="phone" class="form-label">
              Phone
            </label>
            <input type="text" class="form-control" id="phone" name="phone">
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="password" class="form-label">
              Password
            </label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="address" class="form-label">
              Address
            </label>
            <input type="text" class="form-control" id="address" name="address">
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="department" class="form-label">
              department
            </label>
            <select name="department_id" id="department" class="form-select">
              <?php foreach ($departments as $department): ?>
                <option value="<?= $department['id'] ?>"><?= $department['department'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="role" class="form-label">
              Role
            </label>
            <select name="role" id="role" class="form-select">
              <option value="1">Super Admin</option>
              <option value="2">Admin</option>
              <option value="3">employee</option>
            </select>
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="image" class="form-label">Employee image</label>
            <input type="file" class="form-control" id="image" name="image">
          </div>
          <div class="col-12 text-center">
            <button class="btn btn-primary" name="submit">Add Employee</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>





<?php
require_once '../shared/footer.php';
?>