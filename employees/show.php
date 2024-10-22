<?php
//cofig
require_once "c:xampp/htdocs/company31/app/configDB.php";
// UI
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$departmentsQuery = "SELECT * FROM `departments`";
$departments = mysqli_query($con, $departmentsQuery);

if (isset($_GET['show'])) {
  $id = $_GET['show'];
  $selectEmployee = "SELECT * FROM `employeeswithdepartments` where id = $id";
  $selectOne = mysqli_query($con, $selectEmployee);
  $row = mysqli_fetch_assoc($selectOne);
  echo $row['image'];
}
?>


<div class="container col-6 pt-5">
  <h2 class="text-center text-light">Employee: <?= $row['name'] ?></h2>
  <div class="card border-0 mx-auto" style="width: 400px;">
    <img src="./uploads/<?= $row['image'] ?>" alt="" class="immg-fluid">
    <div class="card-body bg-dark text-light">
      <p class="card-text">email: <?= $row['email'] ?></p>
      <p class="card-text">phone: <?= $row['phone'] ?></p>
      <p class="card-text">department: <?= $row['department'] ?></p>
      <p class="card-text">address: <?= $row['address'] ?></p>
    </div>
  </div>
</div>





<?php
require_once '../shared/footer.php';
?>