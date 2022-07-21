<?php include_once "includes/head.php";

include_once "dbConnection.php";

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty($name) || empty($email) || empty($password)) {
        echo "<h2>Input could not be empty</h2>";

        // header("Location: register.php");
    } else {

        $sql = "INSERT INTO `users_with_image` (name,email,password) VALUES ('$name', '$email', '$password')";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            $_SESSION['message'] = "Register successfully";
            header("Location: index.php");
        } else {
            $_SESSION['message'] = "Register successfully";
            header("Location: register.php");
        }
    }
}


?>


<div class="container mt-5">

    <div class="card">
        <div class="card-header">
            <h3>Register Form</h3>
        </div>
        <div class="card-body">
            <form action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
                <div class="form-group mb-3">
                    <label for="" class="form-label">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Enter your name">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Email</label>
                    <input class="form-control" type="text" name="email" placeholder="Enter your email">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Enter your password">
                </div>

                <p class="text-center mt-4">
                    <input class="btn btn-info" name="register" type="submit" value="Register Now">
                </p>
            </form>
        </div>
    </div>
</div>


<?php include_once "includes/footer.php" ?>