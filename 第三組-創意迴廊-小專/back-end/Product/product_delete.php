<?php
require_once("../project-connect.php");


if(!isset($_GET["id"])){
    header("location: 404.php");

}


$vendor_id=$_GET["vendor_id"];
$id = $_GET["id"];
// echo $id;

//DELETE
// $sql="DELETE FROM users WHERE id='$id'";

// SOFT DELETE
$sql="UPDATE product SET valid=0 WHERE id='$id'";

// echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('刪除成功');location.href='product_vendor_list.php?vendor_id=$vendor_id';</script>";
 
   } else {
    echo "刪除資料錯誤:" . $conn->error;
    exit;
   }

 $conn ->close();


?>