<?php
require_once("../project-connect.php");

$id=$_POST["id"];
$name=$_POST["business_name"];
$email=$_POST["account"];
$phone=$_POST["phone"];
//echo $name;

$sql="UPDATE vendor_user SET business_name='$name', account='$email', phone='$phone' WHERE id='$id'";

// echo $sql;
if ($conn->query($sql) === TRUE) {
    	echo "更新成功";
        $conn->close();
        header("location: user.php?id=".$id);
} else {
    	echo "更新資料錯誤: " . $conn->error;
        exit;
}


?>