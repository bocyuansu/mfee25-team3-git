<?php
require_once("../project-connect.php");

if(!isset($_SESSION["user"])){
    header("location: ../Login/back-end-login.php");
    exit;
}

$id=$_POST["id"]; // product.id

$sql = "SELECT * FROM product WHERE product.id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$product_name = $row["product_name"];
$category_id = $row["category_id"];
$category = $row["category"];
$classify_id = $row["classify_id"];
$shelf = $row["shelf"];
$price = $row["price"];
$product_count = $row["product_count"];

if (!$row) {
    header("location: 404.php");
}

// 如果未選擇圖片，則寫回原本的圖片
if (empty($img)){
    header("location: product_complete.php?id=" . $id);
    $img = $row["img"];
}else {
    $img = $_POST["img"];
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
