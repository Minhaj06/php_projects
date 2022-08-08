<?php

include_once "includes/head.php";
include_once "dbConnection.php";

$id = $_GET['id'];

$sql = "SELECT * FROM `users_with_image` WHERE id = '$id' ";

$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);


if (isset($_POST['update_btn'])) {

    $id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $image = $_FILES['image']['name'];


    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['message'] = "Input could not be empty!";
        header("Location: index.php");
        exit(0);
    } else {

        $email_query = mysqli_query($conn, "SELECT email FROM `users_with_image` WHERE email = '$email' ");
        $prev_email = mysqli_fetch_assoc($email_query)['email'];


        if ((mysqli_num_rows($email_query) > 0) && ($email !== $prev_email)) {

            $_SESSION['message'] = "Email alredy exists!";
            header("Location: index.php");
            exit(0);
        } else {


            if (empty($image)) {

                $sql = "UPDATE `users_with_image` SET name='$name',email='$email',password='$password' WHERE id='$id'";

                $query = mysqli_query($conn, $sql);

                if ($query) {

                    $_SESSION['message'] = "User updated successfully";
                    header("Location: index.php");
                } else {
                    $_SESSION['message'] = "User not updated";
                    header("Location: index.php");
                }
            } else {

                $image_tmp_name = $_FILES['image']['tmp_name'];
                $image_ext = explode(".", $image);
                $image_check = strtolower(end($image_ext));
                $rename_image = date("d-m-Y") . "-" . time() . "." . $image_check;
                $image_destinition = 'upload/' . $rename_image;

                $prev_image = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image from `users_with_image` WHERE id = '$id'"))['image'];


                $sql = "UPDATE `users_with_image` SET name='$name',email = '$email', image = '$rename_image', password='$password' WHERE id='$id'";


                if (mysqli_query($conn, $sql)) {
                    unlink('upload/' . $prev_image);
                    move_uploaded_file($image_tmp_name, $image_destinition);

                    $_SESSION['message'] = "User updated successfully";
                    header("Location: index.php");
                } else {
                    $_SESSION['message'] = "User not updated!!";
                    header("Location: index.php");
                }
            }
        }
    }
}
?>


<div class="container mt-5">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Update User</h3>
            <a href="index.php" class="btn btn-info">
                <i class="fa-solid fa-arrow-left"></i>
                Back Home
            </a>
        </div>
        <div class="card-body">
            <form action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="" class="form-label">Name</label>
                    <input class="form-control" type="text" name="name" value="<?= $data['name'] ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Email</label>
                    <input class="form-control" type="text" name="email" value="<?= $data['email'] ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" value="<?= $data['password'] ?>"
                        required>
                </div>

                <p class="text-center mt-4">
                    <input class="btn btn-info" name="update_btn" type="submit" value="Update Now">
                </p>
            </form>
        </div>
    </div>
</div>





<?php include_once 'includes/footer.php' ?>