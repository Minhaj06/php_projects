<?php

include_once "includes/head.php";
include_once "dbConnection.php";

$id = $_GET['id'];

echo "<script>alert($id)</script>";

$sql = "SELECT * FROM `users` WHERE id = '$id' ";

$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);


if (isset($_POST['update_btn'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['message'] = "Input could not be empty!";
        header("Location: edit.php");
        exit(0);
    } else {
        $sql = "UPDATE `users` SET name='$name',email='$email',password='$password' WHERE id='$id'";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            $_SESSION['message'] = "User updated successfully";
            header("Location: index.php");
            exit(0);
        } else {
            $_SESSION['message'] = "User not updated";
            header("Location: edit.php");
            exit(0);
        }
    }
}


?>

<div class="container mt-5">
    <?php include "includes/message.php" ?>
    <div class="card">
        <div class="card-header">
            <h3>Update User</h3>
        </div>
        <div class="card-body">
            <form action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
                <div class="form-group mb-3">
                    <label for="" class="form-label">Name</label>
                    <input class="form-control" type="text" name="name" value="<?= $data['name'] ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Email</label>
                    <input class="form-control" type="text" name="email" value="<?= $data['email'] ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" value="<?= $data['password'] ?>">
                </div>

                <p class="text-center mt-4">
                    <input class="btn btn-info" name="update_btn" type="submit" value="Update Now">
                </p>
            </form>
        </div>
    </div>
</div>





<?php include_once 'includes/footer.php' ?>