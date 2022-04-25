<?php
require_once("../project-connect.php");

if(!isset($_POST["name"])){
    echo "您不是透過正常管道到此頁";
    exit;
}

$name=$_POST["name"];
$account=$_POST["account"];
$password=$_POST["password"];
$phone=$_POST["phone"];
$address=$_POST["address"];

if(empty($name) ||empty($account) ||empty($password) || empty($phone) ||empty($address)){
    echo "<script>alert('您有欄位沒有填寫'); window.location='back-end-signup.php'</script>";
}

date_default_timezone_set("Asia/Taipei");
$now=date('Y-m-d H:i:s');

$sql="INSERT INTO vendor_user (business_name, account, password, phone, address, create_time, valid)
VALUES ('$name', '$account', '$password', '$phone', '$address', '$now', 1)
";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('註冊完成');</script>";
    $last_id=$conn->insert_id;
    
    $sql_2="SELECT * FROM vendor_user WHERE id='$last_id'";
    $result = $conn->query($sql_2);
    $user=$result->fetch_assoc();
    $_SESSION["user"]=[
        "id"=>$user["id"],
        //"business_num"=>$user["business_num"],
        "business_name"=>$user["business_name"],
        "account"=>$user["account"],
        "password"=>$user["password"],
        "phone"=>$user["phone"],
        "address"=>$user["address"],
        "create_time"=>$user["create_time"],
    ];

    $sql_3="SELECT * FROM vendor_user WHERE id=$last_id-1"; //選擇上一筆資料的編號         ex:bus_001
    $result_3 = $conn->query($sql_3);
    $user_3 = $result_3->fetch_assoc();

    $Arr=str_split($user_3["business_num"],4); //上一筆資料編號，切割英文字，數字（字串型別） ex:bus_、001
    $Stringnum=$Arr[1];                        //選擇數字（字串型別）                       ex: 001
    $Intnum=intval($Stringnum); //把數字（字串型別） 變 數字（數字型別），但是字首是0會消失不見 ex: 01
    $Addnum=$Intnum+1;                     //數字+1                                        ex: 02
    $Arr2=[$Arr[0],0,$Addnum];             // 把bus_、0、02 組裝在一起，變成陣列          ex:bus_002
    $new_business_num_string = implode("",$Arr2);  //把組裝好的陣列，改回字串型別
    var_dump($new_business_num_string);    //顯示出來，看有沒有成功
    
    $sql_4="UPDATE vendor_user SET business_num='$new_business_num_string' WHERE id='$last_id'";
    $result4 = $conn->query($sql_4);    //選擇好下一筆資料，把編號bus_002塞進去，然後執行它     
    // $user4 = $result4->fetch_all(MYSQLI_ASSOC);
    // var_dump($result4);

    $sql_5="SELECT * FROM vendor_user WHERE id='$last_id'";
    $result5 = $conn->query($sql_5);
    $user5=$result5->fetch_assoc();
    // echo "<hr>";
    // var_dump($user5);
    // echo "<hr>";
    // echo $user5["business_num"];
    // echo "<hr>";
    $_SESSION["user"]=[
        "id"=>$user["id"],
        "business_num"=>$user5["business_num"],
        "business_name"=>$user["business_name"],
        "account"=>$user["account"],
        "password"=>$user["password"],
        "phone"=>$user["phone"],
        "address"=>$user["address"],
        "create_time"=>$user["create_time"],
    ];
    var_dump($_SESSION["user"]);
    echo "<script>window.location='../Vendor/back-end-vendor-read.php'</script>";

} else {
    echo "新增資料錯誤: " . $conn->error;
    header("location: back-end-signup.php");
}


?>