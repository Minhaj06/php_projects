<?php
include_once 'dbConnection.php';
$id = $_GET['id'];

$sql = "DELETE FROM `users` WHERE id='$id'";

$query = mysqli_query($conn, $sql);

if ($query) {
    $_SESSION['message'] = "User deleted successfully";
    header("Location: index.php");
} else {
    $_SESSION['message'] = "User not deleted";
    header("Location: index.php");
}