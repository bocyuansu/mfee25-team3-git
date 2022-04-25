<?php
require_once("../project-connect.php");

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
        form .btn {
            display: block;
            width: 100px;
        }
        .save-btn, .cancel-btn {
            background-color: #CA965C !important;
        }
    </style>
  </head>
  <body>
    <?php require("../layout/be-header.php"); ?>
    <div class="d-flex">
        <?php require("../layout/be-vendor-sidebar.php"); ?>
        <div class="container">
            <p class="mb-4">賣家資料管理/基本資料/修改基本資料</p>
            <form action="back-end-vendor-do-edit.php" method="post">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-end">公司名稱：</th>
                        <td><input type="text" name="business_name" value="<?=$_SESSION["user"]["business_name"]?>"></td>
                    </tr>
                    <tr>
                        <th class="text-end">帳號（信箱）：</th>
                        <td><input type="text" name="account" value="<?=$_SESSION["user"]["account"]?>"></td>
                    </tr>
                    <tr>
                        <th class="text-end">密碼：</th>
                        <td><input type="password" name="password" value="<?=$_SESSION["user"]["password"]?>"></td>
                    </tr>
                    <tr>
                        <th class="text-end">新密碼：</th>
                        <td><input type="password" name="password" value="<?=$_SESSION["user"]["password"]?>"></td>
                    </tr>
                    <tr>
                        <th class="text-end">手機：</th>
                        <td><input type="text" name="phone" value="<?=$_SESSION["user"]["phone"]?>"></td>
                    </tr>
                    <tr>
                        <th class="text-end">地址：</th>
                        <td><input type="text" name="address" value="<?=$_SESSION["user"]["address"]?>"></td>
                    </tr>
                </table>
                    <div class="d-flex justify-content-end py-2">
                    <a class="btn cancel-btn text-white mx-2" href="back-end-vendor-read.php">取消修改</a>
                    <button type="submit" class="btn save-btn text-center text-white">儲存</button>
                    </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../layout/sidebars.php"></script>
  </body>
</html>