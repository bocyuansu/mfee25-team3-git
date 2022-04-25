<?php
session_start();
if(isset($_SESSION["user"])){
    header("location: ../Vendor/back-end-vendor-read.php");
} 
//若使用者已登入，無法連到login.php頁面，會跳到首頁index_end.php
?>
<!doctype html>
<html lang="en">
  <head>
    <title>後台登入系統</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/be-css.css">

    <style>
        .avatar {
            width: 450px;
            margin: 50px auto;

        }
        .card {
            border-radius: 10px;
        }
        .card .logo {
            width: 200px;
            height: 200px;
            border: 1px dotted gray;
            border-radius: 50%;
            margin: 0 auto;
            background-color: #CA965C;

        }
        .card .title {
            margin: 0 auto;
        }
        .card ul {
            list-style: none;
        }
        .my-btn{
            font-size: 16px;
            padding: 6px 12px;
            color: #FFF;
            background-color: #CA965C;
            border: 0;
            border-radius: 0.25rem;
        }
    </style>
  </head>
  <body>
      <?php require("../layout/be-login.php"); ?>
        <div class="avatar">
            <form class="card p-3" action="back-end-do-login.php" method="post">
                <figure class="logo">
                    <img src="../layout/img/logo2.svg" alt="">

                </figure>
                <h2 class="title">後台登入系統</h2>
                <label for="">帳號</label>
                <input class="form-control mb-4" name="account" type="text" placeholder="請輸入電子信箱">
                <label for="">密碼</label>
                <input class="form-control" name="password" type="password" placeholder="請輸入密碼">
                <ul class="d-flex justify-content-end">
                    <li class="border-end my-2 px-3"><a href="../Signup/back-end-signup.php">註冊</a></li>
                    <li class="my-2 px-3"><a href="#">忘記密碼</a></li>
                </ul>
                <button class="my-btn m-5">登入</button>
            </form>

        </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>