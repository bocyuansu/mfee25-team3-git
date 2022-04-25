<?php
require_once("../project-connect.php");
$classify_id = $_POST["classify_id"];
// 使用方法2再寫這行，將上一層值接過來
// $classify_name = $_POST["classify_name"];
// 因為在上一層admin-category-doCreate.php用POST將classify_id值傳過來，所以要再用一個POST接，並在第18-19行將classify_id值寫入
// location的最後面都加上 &classify_name=<?= $row["classify_name"] 來抓值

if (!isset($_POST["category_name"])) {
    echo "您不是透過正常管道到此頁";
    exit;
}

$category_name = $_POST["category_name"];
if (empty($category_name)) {
    echo "您有欄位沒有填寫";
    return;
}

$sql_category = "INSERT INTO category (category_name,classify_id)
    VALUES ('$category_name','$classify_id')";

if ($conn->query($sql_category) === TRUE) {
    echo "新增資料完成<br>";
    $last_id = $conn->insert_id; // 最新資料取得
    // echo "last id is $last_id";
    // exit;
} else {
    echo "新增資料錯誤: " . $conn->error;
    exit; // 錯誤的話會停在這
}

$conn->close();
// echo "<script>history.back(-2)</script>"
// echo "<script> location.href = document.referrer; </script>" 
// JS語法：獲取上一個訪問頁面的URL地址document.referrer實現

header("location: admin-category.php?type=1&classify_id=" . $classify_id);
        // print_r($classify_id)
