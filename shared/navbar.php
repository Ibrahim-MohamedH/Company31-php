<?php
// config
require_once 'C:xampp/htdocs/company31/app/functions.php';
if (isset($_POST['logout'])) {
  session_unset();
  path('login.php');
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="<?= URL('') ?>">Company</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URL('') ?>">Home</a>
        </li>
        <?php if (isset($_SESSION['employee'])): ?>
          <?php if ($_SESSION['employee']['role'] == 1 || $_SESSION['employee']['role'] == 2): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Employees
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= URL('employees/add.php') ?>">Add Employee</a></li>
                <li><a class="dropdown-item" href="<?= URL('employees/list.php') ?>">List Employees</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Department
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= URL('departments/add.php') ?>">Add Department</a></li>
                <li><a class="dropdown-item" href="<?= URL('departments/list.php') ?>">List Departments</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categories
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= URL('categories/add.php') ?>">Add Category</a></li>
                <li><a class="dropdown-item" href="<?= URL('categories/list.php') ?>">List Categories</a></li>
              </ul>
            </li>
          <?php endif ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              products
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= URL('products/add.php') ?>">Add Product</a></li>
              <li><a class="dropdown-item" href="<?= URL('products/list.php') ?>">List Products</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img width="50" src="<?= URL('employees/uploads/') . $_SESSION['employee']['image'] ?>" class="rounded-circle">
              <?= $_SESSION['employee']['name'] ?>
            </a>
            <ul class="dropdown-menu">
              <li>
                <form class="dropdown-item" method="POST">
                  <button name='logout' class="btn text-danger">log out</button>
                </form>
              </li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= URL('login.php') ?>">Sign in</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>