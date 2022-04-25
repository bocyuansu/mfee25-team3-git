<?php
require_once("../project-connect.php");

$account=$_POST["account"];
$password=$_POST["password"];

$sql="SELECT * FROM admin_user WHERE account='$account' AND password='$password'";
$result = $conn->query($sql);
$resultCount= $result->num_rows;

if($resultCount>0){
  $user=$result->fetch_assoc();

  $_SESSION["user"]=[
      "id"=>$user["id"],
      "name"=>$user["name"],
      "account"=>$user["account"],
      "password"=>$user["password"],
      "create_time"=>$user["create_time"],
  ];
  echo "<script>alert('登入成功'); window.location='../Business/user-list.php';</script>";
}else{
  echo "<script>alert('登入失敗，請重新輸入'); window.location='admin-login.php';</script>";
}

?>
