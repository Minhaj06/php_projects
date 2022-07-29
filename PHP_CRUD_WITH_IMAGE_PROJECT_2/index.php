<?php

include_once "includes/head.php";
include_once "dbConnection.php";

$sql = "SELECT * FROM `users_with_image`";

$query = mysqli_query($conn, $sql);

?>

<div class="container my-5">

    <?php include "includes/message.php" ?>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h2 class="mb-0">PHP - CRUD</h2>

            <a href="register.php" class="btn btn-info">Register</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" style="min-width: 700px;">
                    <thead>
                        <tr>
                            <th class="align-middle">ID</th>
                            <th class="align-middle">Image</th>
                            <th class="align-middle">Name</th>
                            <th class="align-middle">Email</th>
                            <th class="align-middle">Password</th>
                            <th class="align-middle">Confirm Password</th>
                            <th class="align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $id = 1;

                        if (mysqli_num_rows($query) > 0) {
                            foreach ($query as $row) {

                        ?>

                        <tr>
                            <td><?= $id ?></td>
                            <td><img src="upload/<?= $row['image'] ?>" alt="user_image" width="80" height="60"></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['password'] ?></td>
                            <td><?= $row['c_password'] ?></td>
                            <td>
                                <a class="text-warning px-2 py-1" href="edit.php?id=<?= $row['id'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="text-danger px-2 py-1" href="delete.php?id=<?= $row['id'] ?>">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>

                        <?php

                                $id++;
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php" ?>