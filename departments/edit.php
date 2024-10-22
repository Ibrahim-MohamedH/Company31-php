<?php
//cofig
require_once "c:xampp/htdocs/company31/app/configDB.php";
require_once "c:xampp/htdocs/company31/app/functions.php";
// UI
require_once '../shared/header.php';
require_once '../shared/navbar.php';
auth(2);

$department = '';
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $selectOneQuery = "SELECT * FROM `departments` WHERE id = $id";
  $selectOne = mysqli_query($con, $selectOneQuery);
  $row = mysqli_fetch_assoc($selectOne);
  $department = $row['department'];
  if (isset($_POST['department'])) {
    $department = $_POST['department'];
    $updateQuery = "UPDATE `departments` SET department = '$department' WHERE id = $id";
    $update = mysqli_query($con, $updateQuery);
    if ($update) {
      path('departments/list.php');
    }
  }
}

?>


<div class="container col-6 pt-5">
  <h2 class="text-center  text-light">Update Department</h2>
  <div class="card border-0">
    <div class="card-body bg-dark text-light">
      <?php if (!empty($message)) : ?>
        <div class="alert alert-success">
          <p class="fs-4 mb-0"><?= $message ?></p>
        </div>
      <?php endif; ?>
      <form method="POST">
        <div class="form-group mb-2">
          <label for="department" class="form-label">
            Department
          </label>
          <input type="text" value="<?= $department ?>" class="form-control" id="department" name="department">
        </div>
        <div class="text-center">
          <button class="btn btn-warning">Update Department</button>
        </div>
      </form>
    </div>
  </div>
</div>






<?php
require_once '../shared/footer.php';
?>