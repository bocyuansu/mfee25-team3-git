<?php

require_once("db-connect.php");

$id=$_POST["id"];
$product_name=$_POST["product_name"];
$category=$_POST["category"];
$price=$_POST["price"];
$product_count=$_POST["product_count"];
$img=$_POST["img"];

$sql="UPDATE product SET product_name='$product_name',category='$category', price='$price' , product_count='$product_count', img='$img' WHERE id='$id'";

// echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('更改完成');location.href='product_complete.php?id=$id';</script>";
    $conn ->close();
   

} else {
    echo "編輯資料錯誤:" . $conn->error;
    exit;
   }


  
?>
