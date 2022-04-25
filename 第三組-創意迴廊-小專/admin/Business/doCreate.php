<?php
require_once("../project-connect.php");

if(!isset($_POST["business_name"])){
    echo "您不是透過正常管道到此頁";
    exit;
}

$name=$_POST["business_name"];
$email=$_POST["account"];
$password=$_POST["password"];
$phone=$_POST["phone"]; 
$address=$_POST["address"];

$now=date('Y-m-d H:i:s');

$sql = "SELECT business_num FROM vendor_user
    ORDER BY business_num DESC
    LIMIT 1";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();
    $business_num=$row["business_num"];
    $new_num=substr($business_num, -3)+1;
    
    if(strlen($new_num)!=3){
        $new_num="bus_0".$new_num;
    }
    else{
        $new_num="bus_".$new_num;
    }
    

if(empty($name) || empty($email) || empty($phone) || empty($password) || empty($address)){
    echo "您有欄位沒有填寫";
    return;
}

$sql="INSERT INTO vendor_user (business_num,business_name, account, password, phone, address, create_time, valid)
VALUES ('$new_num','$name','$email', '$password', '$phone', '$address', '$now',1)
";

// echo $sql;
// exit;

if ($conn->query($sql) === TRUE) {
    echo "新增資料完成";
    $last_id=$conn->insert_id;
    // echo "last id is $last_id";
    // exit;

} else {
    echo "新增資料錯誤: ".$conn->error;
    exit;
}

$conn->close();

header("location: user-list.php");

?>

<!doctype html>
<html lang="en">
<head>
    <title>Admin後台</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/ad-css.css">
    <style>
    
    .container .btn{
      background: #CA965C;
      border:#CA965C;
    }
</style>

</head>

<body>
    <?php require_once("../layout/ad-header.php"); ?>
    <div class="d-flex">
        <?php require_once("../layout/ad-business-sidebar.php"); ?>
        <div class="container">
        <div class="py-2 text-center">
        <h2><?php if ($conn->query($sql) === TRUE) {
                echo "新增成功";
            } else {
                echo "新增資料錯誤: " . $conn->error;
            }
            $conn->close();
            ?></h2>
        <a class="btn btn-info text-white" href="customer-user-list.php">回列表</a>
    </div>
        </div>
    </div>



    <script src="sidebars.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>