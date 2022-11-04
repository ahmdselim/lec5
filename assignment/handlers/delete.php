<?php
require_once("../inc/header.php");
session_start();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $selectTable = "SELECT * FROM `items` WHERE id = '$id'";
    $dbQuery = mysqli_query($con, $selectTable);
    if (mysqli_fetch_assoc($dbQuery) > 0) {
        $deleteItem = "DELETE FROM `items` WHERE id = '$id'";
        $dbQuery = mysqli_query($con, $deleteItem);
        $_SESSION["success_id"] = "deleted success";
        header("location:../pages/index.php");
    } else {
        unset($_SESSION["success_id"]);
        $_SESSION["error_id"] = "id no true please don't play at url my code is perfect 😉";
        header("location:../pages/index.php");
    }
} else {
    header("location:../pages/index.php");
}
