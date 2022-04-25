<?php
require_once("db-connect.php");


if(!isset($_GET["id"])){
    header("location: 404.php");

}

$id=$_GET["id"];
// echo $id;

//DELETE
// $sql="DELETE FROM users WHERE id='$id'";

// SOFT DELETE
$sql="UPDATE product SET valid=0 WHERE id='$id'";

// echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('刪除成功');location.href='product_list.php?id=$id';</script>";
 
   } else {
    echo "刪除資料錯誤:" . $conn->error;
    exit;
   }

 $conn ->close();


?>