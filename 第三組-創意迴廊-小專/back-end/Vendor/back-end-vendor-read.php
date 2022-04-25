<?php

require_once("../project-connect.php");

$sql="SELECT * FROM vendor_user";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/be-css.css">
    <style>
        .profile_edit {
            background-color: #CA965C !important;
        }
    </style>
  </head>
  <body>
    <?php require("../layout/be-header.php"); ?>
    <div class="d-flex">
        <?php require("../layout/be-vendor-sidebar.php"); ?>
        <div class="container">
            <p class="mb-4">賣家資料管理/基本資料</p>
            <table class="table table-borderless">
                <tr class="row">
                    <th class="text-end col-5">廠商編號：</th>
                    <td class="col-7"><?=$_SESSION["user"]["business_num"]?></td>
                </tr>
                <tr class="row">
                    <th class="text-end col-5">公司名稱：</th>
                    <td class="col-7"><?=$_SESSION["user"]["business_name"]?></td>
                </tr>
                <tr class="row">
                    <th class="text-end col-5">帳號（信箱）：</th>
                    <td class="col-7"><?=$_SESSION["user"]["account"]?></td>
                </tr>
                <tr class="row">
                    <th class="text-end col-5">手機：</th>
                    <td class="col-7"><?=$_SESSION["user"]["phone"]?></td>
                </tr>
                <tr class="row">
                    <th class="text-end col-5">公司地址：</th>
                    <td class="col-7"><?=$_SESSION["user"]["address"]?></td>
                </tr>
            </table>
            <div class="d-flex justify-content-end">
                <button class="profile_edit btn text-white">修改資料</button>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../layout/sidebars.php"></script>
    <script>
        let click = document.querySelector('.profile_edit');
        click.addEventListener("click",function(){window.location='back-end-vendor-edit.php'});
    </script>
  </body>
</html>