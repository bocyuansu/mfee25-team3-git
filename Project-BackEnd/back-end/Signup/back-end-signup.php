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

        form button {
            display: block;
            width: 100px;
        }
    </style>
  </head>
  <body>
    <?php require("../layout/be-login.php"); ?>
        <div class="container">
            <h1 class="text-center mb-4">賣家註冊</h1>
            <form  action="back-end-do-signup.php" method="post">
                <div class="row mb-4">
                    <label class="col-3 text-end" for="">公司名稱：</label>
                    <input class="col-9" type="text" name="name" required>
                </div>
                <div class="row mb-4">
                    <label class="col-3 text-end" for="">帳號（信箱）：</label>
                    <input class="col-9" type="text" name="account" required>
                </div>
                <div class="row mb-4">
                    <label class="col-3 text-end" for="">密碼：</label>
                    <input class="col-9" type="password" name="password" required>
                </div>
                <div class="row mb-4">
                    <label class="col-3 text-end" for="">請再確認密碼：</label>
                    <input class="col-9" type="password" name="password" required>
                </div>
                <div class="row mb-4">
                    <label class="col-3 text-end" for="">手機：</label>
                    <input class="col-9" type="text" name="phone" required>
                </div>
                <div class="row mb-4">
                    <label class="col-3 text-end" for="">地址：</label>
                    <input class="col-9" type="text" name="address" required>
                </div>
                <div class="d-flex justify-content-center">
                <button class="btn btn-info text-center">註冊</button>
                </div>
            </form>
        </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>