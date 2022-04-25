<?php
require_once("../project-connect.php");

$account=$_POST["account"];
$password=$_POST["password"];

$sql="SELECT * FROM vendor_user WHERE account='$account' AND password='$password'";
$result = $conn->query($sql);
$resultCount= $result->num_rows;

if($resultCount>0){
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
  echo "<script>alert('登入成功'); window.location='../Vendor/back-end-vendor-read.php';</script>";
}else{
  echo "<script>alert('登入失敗，請重新輸入'); window.location='back-end-login.php';</script>";
}
?>
