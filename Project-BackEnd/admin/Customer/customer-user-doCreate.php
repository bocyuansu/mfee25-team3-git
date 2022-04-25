<?php
    require_once("../project-connect.php");

    if(!isset($_POST["name"])){
        echo "您不是透過正常管道到此頁";
        exit;
    }

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    
    $sql = "SELECT member_num FROM customer_user
    ORDER BY member_num DESC
    LIMIT 1";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();
    $member_num=$row["member_num"];
    $new_num=substr($member_num, -3)+1;
    
    if(strlen($new_num)!=3){
        $new_num="cus_0".$new_num;
    }
    else{
        $new_num="cus_".$new_num;
    }
    


    // date_default_timezone_set("Asia/Taipei");
    $now=date('Y-m-d H:i:s');
    // $phones=join(",",$phone);

    if(empty($name) || empty($email) || empty($phone)){
        echo "您有欄位沒有填寫";
        return;
    }


    $sql="INSERT INTO customer_user(member_num,member_name,account,password,gender,age,address,phone,create_time,valid) VALUES ('$new_num','$name','$email','$password','$gender','$age','$address','$phone','$now',1)";
   

   
    
    
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
        <?php require_once("../layout/admin-customer-sidebar.php"); ?>
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