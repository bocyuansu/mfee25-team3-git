<?php
require_once("../project-connect.php");

if(!isset($_SESSION["user"])){
    header("location: ../Login/back-end-login.php");
    exit;
}

$id=$_SESSION["user"]["id"];
$name=$_POST["business_name"];
$account=$_POST["account"];
$password=$_POST["password"];
$phone=$_POST["phone"];
$address=$_POST["address"];

if(empty($name) ||empty($account) ||empty($password) || empty($phone) ||empty($address)){
    echo "<script>alert('您有欄位沒有填寫'); window.location='back-end-vendor-edit.php'</script>";
    exit;
}
$sql="UPDATE vendor_user SET business_name='$name', account='$account', password='$password', phone='$phone', address='$address' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('更新成功'); </script>";
    
    $sql_2="SELECT * FROM vendor_user WHERE id='$id'";
    $result = $conn->query($sql_2);
    $user=$result->fetch_assoc();
    $_SESSION["user"]=[
        "id"=>$user["id"],
        "business_num"=>$user["business_num"],
        "business_name"=>$user["business_name"],
        "account"=>$user["account"],
        "password"=>$user["password"],
        "phone"=>$user["phone"],
        "address"=>$user["address"],
        "create_time"=>$user["create_time"],
    ];
    
    echo "<script>window.location='back-end-vendor-read.php';</script>";
} else {
    echo "<script>alert('更新資料錯誤'); </script>";
    echo "<script>window.location='back-end-vendor-read.php';</script>";
}

?>


