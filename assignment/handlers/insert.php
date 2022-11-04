<?php
session_start();
require_once("../inc/header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = trim(htmlspecialchars(htmlentities($_POST["data"])));
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "todoApp";
    $error = [];

    if (empty($data)) {
        $error[] = "data is required";
    } elseif (strlen($data) > 100) {
        $error[] = "data must be less than 100 char";
    }

    if (!empty($error)) {
        $_SESSION["error"] = $error;
        header("location:../pages/index.php");
    } else {
        unset($_SESSION["error"]);
        $con = mysqli_connect($host, $username, $password, $db);
        $createTable = "CREATE TABLE IF NOT EXISTS items (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL
    )";
        $dbQuery = mysqli_query($con, $createTable);

        mysqli_close($con);

        $con = mysqli_connect($host, $username, $password, $db);
        $insertDB = "INSERT INTO `items`(`name`) VALUES ('$data')";
        $dbQuery = mysqli_query($con, $insertDB);
        mysqli_close($con);
        $_SESSION["success"] = "data inserted success";
        header("location:../pages/index.php");
    }
} else {
    header("location:../pages/index.php");
}
