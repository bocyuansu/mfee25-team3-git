
<?php
// api 有找到 status =1 + 陣列, 沒找到或是沒輸入 status=0
require("db-connect.php");

if (!isset($_POST["id"])) {

    $data = [
        "status" => 0
    ];
    echo json_encode($data);
    exit;
}

$id = $_POST["id"];


$sql = "SELECT id, category_name FROM category
WHERE classify_id=$id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rows= $result->fetch_all(MYSQLI_ASSOC);
    $data = [
        "status" => 1,
        "data" => $rows
    ];
} else {
    $data = [
        "status" => 0
    ];
}
echo json_encode($data);
