<?php
require_once 'C:xampp/htdocs/company31/app/configDB.php';
require_once 'C:xampp/htdocs/company31/app/functions.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$selectQuery = "SELECT * FROM `employees`";
$select = mysqli_query($con, $selectQuery);
// $egt = mysqli_fetch_all($select);

// print_r($egt);
$numofRows = mysqli_num_rows($select);
?>





<div class="container pt-5">
    <h2 class="text-center text-light">LIST ALL Employees</h2>
    <div class="card border-0">
        <div class="card-body bg-dark text-light">

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department_ID</th>
                        <th>Address</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($numofRows > 0): ?>
                        <?php foreach ($select as $index => $dep): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $dep['name'] ?></td>
                                <td><?= $dep['email'] ?></td>
                                <td><?= $dep['department_id'] ?></td>
                                <td><?= $dep['address'] ?></td>
                                <td><?= $dep['phone'] ?></td>
                                <td>
                                    <a href="edit.php?edit=<?= $dep['id']; ?>" class="btn btn-warning">EDIT</a>
                                </td>
                                <td>
                                    <a href="?delete=<?= $dep['id']; ?>" class="btn btn-danger">DELETE</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-center">NO DATA AVAILABLE</td>
                        </tr>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</div>














<?php

require_once '../shared/footer.php';
?>