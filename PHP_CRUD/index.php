<?php

include_once "includes/head.php";
include_once "dbConnection.php";

$sql = "SELECT * FROM `users`";

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
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Edit</th>
                            <th>Delete</th>
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
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['password'] ?></td>
                            <td>
                                <a class="btn btn-warning px-2 py-1" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-danger px-2 py-1" href="delete.php?id=<?= $row['id'] ?>">Delete</a>
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