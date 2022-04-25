<?php
require_once("../project-connect.php");

$id=$_POST["id"];
$name=$_POST["member_name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$password=$_POST["password"];
$gender=$_POST["gender"];
$address=$_POST["address"];

// echo $name;

$sql="UPDATE customer_user SET member_name='$name', account='$email', phone='$phone',password='$password',gender='$gender',address='$address' WHERE id='$id'";

// echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "更新成功";
    $conn->close();
    header("location: customer-user.php?id=".$id);
} else {
    echo "更新資料錯誤: " . $conn->error;
    exit;
}




?>