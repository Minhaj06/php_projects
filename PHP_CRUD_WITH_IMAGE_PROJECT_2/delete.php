<?php
include_once 'dbConnection.php';

$id = $_GET['id'];
$sql = "DELETE FROM `users_with_image` WHERE id='$id'";

$prev_image = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image from `users_with_image` WHERE id = '$id'"))['image'];


if (mysqli_query($conn, $sql)) {

    unlink('upload/' . $prev_image);

    $_SESSION['message'] = "User deleted successfully";
    header("Location: index.php");
} else {
    $_SESSION['message'] = "User not deleted";
    header("Location: index.php");
}