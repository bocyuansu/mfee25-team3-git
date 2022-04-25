<?php

require_once("../project-connect.php");

$id=$_POST["id"];
$product_name=$_POST["product_name"];
$category_id=$_POST["category_id"];
$classify_id=$_POST["classify_id"];
$category=$_POST["category"];
$shelf=$_POST["shelf"];
$price=$_POST["price"];
$product_count=$_POST["product_count"];
$img=$_POST["img"];

$sql = "SELECT * FROM product WHERE id='$id' AND valid=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if (!$row) {
    header("location: 404.php");
}



if (empty($img)){
    header("location: product_complete.php?id=" . $id);
    $img = $row["img"];
}else {
    $img=$_POST["img"];
}



$sql="UPDATE product SET product_name='$product_name', category_id = '$category_id' ,classify_id= '$classify_id', category='$category', price='$price' , product_count='$product_count', shelf= '$shelf', img='$img' WHERE id='$id'";

// echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('完成更改');location.href='product_complete.php?id=$id';</script>";
    $conn ->close();
   

} else {
    echo "編輯資料錯誤:" . $conn->error;
    exit;
   }


  
?>
