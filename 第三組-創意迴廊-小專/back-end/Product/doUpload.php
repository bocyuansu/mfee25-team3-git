<?php
require_once("../project-connect.php");



// $product_num=$_POST["product_num"];
$product_name=$_POST["product_name"];
$vendor_id=$_POST["vendor_id"];
$price=$_POST["price"];
$img=$_POST["img"];
$product_count=$_POST["product_count"];
$classify_id=$_POST["classify_id"];
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
// echo $product_newnum;
// echo "<hr>";
// echo $product_name;
// echo "<hr>";
// echo $vendor_id;
// echo "<hr>";
// echo $price;
// echo "<hr>";
// echo $product_count;
// echo "<hr>";
// echo $img;
// echo "<hr>";
// echo $classify_id;
// echo "<hr>";
// echo $category_id;
// exit;

$sql="INSERT INTO product (product_num, product_name, vendor_id, price, img, product_count, classify_id, category_id, valid) VALUES ('$product_newnum', '$product_name', '$vendor_id','$price', '$img', '$product_count','$classify_id', '$category_id', 1)";
        

      
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('新增完成');location.href='product_vendor_list.php?vendor_id=$vendor_id';</script>";
   
    
    
} else {
    echo "新增資料錯誤:" . $conn->error;
    exit;
}
$conn ->close();
// header("location: product_list.php");

?>