<?php
//cofig
require_once "c:xampp/htdocs/company31/app/configDB.php";
require_once "c:xampp/htdocs/company31/app/functions.php";
// UI
require_once './shared/header.php';
require_once './shared/navbar.php';
$error = '';
if (isset($_POST['signIn'])) {
  $email = $_POST['email'];
  $password = sha1($_POST['password']);
  $searchQuery = "SELECT * FROM `employees` WHERE email = '$email' AND `password` = '$password'";
  $search = mysqli_query($con, $searchQuery);
  if (mysqli_num_rows($search) == 1) {
    $emp = mysqli_fetch_assoc($search);
    $_SESSION['employee'] = [
      'id' => $emp['id'],
      'name' => $emp['name'],
      'email' => $emp['email'],
      'image' => $emp['image'],
      'address' => $emp['address'],
      'phone' => $emp['phone'],
      'department_id' => $emp['department_id'],
      'role' => $emp['role'],
    ];
    path('');
  } else {
    $error = "البيانات غير صحيحة! امشي من هنا";
  }
}
?>



<div class="container col-6">
  <h3 class="text-center">Sign In</h3>
  <div class="card card-body bg-dark text-light">
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger">
        <?= $error ?>
      </div>
    <?php endif; ?>
    <form method="POST">
      <div class="row">
        <div class="col-12 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="col-12 mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="col-12 text-center">
          <button class="btn btn-primary" name="signIn">
            sign in
          </button>
        </div>
      </div>
    </form>
  </div>
</div>






<?php
require_once './shared/footer.php';
?>