<?php include_once "includes/head.php";

include_once "dbConnection.php";

if (isset($_POST['register_btn'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $image = $_FILES['image']['name'];


    if (empty($name) || empty($email) || empty($image) || empty($password) || empty($c_password)) {
        $_SESSION['message'] = "Input could not be empty!";
        header("Location: register.php");
        exit(0);
    } else {

        if ($password !== $c_password) {
            $_SESSION['message'] = "Password and confirm password not matched!";
            header("Location: register.php");
            exit(0);
        } else {
            $email_query = mysqli_query($conn, "SELECT email FROM `users_with_image` WHERE email = '$email' ");

            if (mysqli_num_rows($email_query) > 0) {

                $_SESSION['message'] = "Email alredy exists!";
                header("Location: register.php");
                exit(0);
            } else {

                $image_tmp_name = $_FILES['image']['tmp_name'];
                $image_ext = explode(".", $image);
                $image_check = strtolower(end($image_ext));
                $rename_image = date("d-m-Y") . "-" . time() . "." . $image_check;
                $image_destinition = 'upload/' . $rename_image;

                $sql = "INSERT INTO `users_with_image` (name, email, image, password) VALUES ('$name', '$email', '$rename_image', '$password')";

                $query = mysqli_query($conn, $sql);

                if ($query) {

                    move_uploaded_file($image_tmp_name, $image_destinition);

                    $_SESSION['message'] = "Registered successfully";
                    header("Location: index.php");
                    exit(0);
                } else {
                    $_SESSION['message'] = "Some went worng!";
                    header("Location: register.php");
                    exit(0);
                }
            }
        }
    }
}


?>


<div class="container mt-5">
    <?php include "includes/message.php" ?>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Register Form</h3>
            <a href="index.php" class="btn btn-info">
                <i class="fa-solid fa-arrow-left"></i>
                Back Home
            </a>
        </div>
        <div class="card-body">
            <form action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="" class="form-label">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Enter your name" required>
                </div>

                <div class="form-group mb-3">
                    <label for="" class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" type="file" name="image" required>
                </div>

                <div class="form-group mb-3">
                    <label for="" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Enter your password"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="" class="form-label">Confirm Password</label>
                    <input class="form-control" type="password" name="c_password" placeholder="Enter your password"
                        required>
                </div>


                <input class="btn btn-info" name="register_btn" type="submit" value="Register Now">

            </form>
        </div>
    </div>
</div>


<?php include_once "includes/footer.php" ?>