<?php
require_once("db-connect.php");


$id=$_POST["id"];
$product_num=$_POST["product_num"];
$product_name=$_POST["product_name"];
$product_brand=$_POST["product_brand"];
$vendor_id=$_POST["vendor_id"];
$price=$_POST["price"];
$img=$_POST["img"];
$classify_id=$_POST["classify_id"];
$category=$_POST["category"];
$category_id=$_POST["category_id"];



$sql = "SELECT * FROM product WHERE category_id = $category_id";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

$length = count($rows);
$last = 0;
$last = $length - 1;
// echo "$length";

// print_r($rows[$last]["product_num"]); //a010

$product_number=$rows[$last]["product_num"];




// substr("$product_number", 1, 3 );
$num_end= substr("$product_number", 1, 3 ); //0xx  string

$num_start= substr("$product_number", 0, 1 ); //Eng
$num_end= (int)$num_end+1;
// echo ($num_end);

// echo "$num_start" ."0". $num_end;

$product_newnum="$num_start" ."0". $num_end;


// if(empty($product_name) || empty($price) || empty($img) || empty($classify_id) || empty($category_id)){   
//     echo "您有欄位沒有填寫";
//     return;
// }


$sql="INSERT INTO product (product_num, product_name, product_brand, vendor_id, price, img, classify_id, category, category_id, valid) VALUES ('$product_newnum', '$product_name', '$product_brand', '$vendor_id','$price', '$img', '$classify_id','$category', '$category_id', 1)";
        

      
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('新增完成');location.href='product_list.php?id=$id';</script>";
   
    
    
} else {
    echo "新增資料錯誤:" . $conn->error;
    exit;
}
$conn ->close();
// header("location: product_list.php");

?>