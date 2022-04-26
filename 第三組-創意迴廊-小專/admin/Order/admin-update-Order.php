<?php
require_once("../project-connect.php");

$id = $_POST["id"];
$address = $_POST["address"];

$sql = "UPDATE user_order SET order_address = '$address' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
    $conn -> close();
    header("location: admin-order-detail.php?id=" . $id);
} else {
    echo "更新資料錯誤: " . $conn->error;
    exit;
}

$conn -> close();

?>

