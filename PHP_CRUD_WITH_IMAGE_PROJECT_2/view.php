<?php

include_once "includes/head.php";
include_once "dbConnection.php";

$id = $_GET['id'];

$sql = "SELECT * FROM `users_with_image` WHERE id = '$id' ";

$query = mysqli_query($conn, $sql);

$result = mysqli_fetch_assoc($query);
?>


<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>View User Data</h1>
            <a href="index.php" class="btn btn-info">
                <i class="fa-solid fa-arrow-left"></i>
                Back Home
            </a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle"><?= $result['id'] ?></td>
                        <td class="align-middle">
                            <img src="upload/<?= $result['image'] ?>" width="150" alt="User image">
                        </td>
                        <td class="align-middle"><?= $result['name'] ?></td>
                        <td class="align-middle"><?= $result['email'] ?></td>
                        <td class="align-middle"><?= $result['password'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>