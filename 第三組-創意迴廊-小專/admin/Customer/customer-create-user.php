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
    .container{
        height: 710px;
    }
</style>
</head>

<body>
    <?php require_once("../layout/ad-header.php"); ?>
    <div class="d-flex">
        <?php require_once("../layout/admin-customer-sidebar.php"); ?>
        <div class="container">
        <form action="customer-user-doCreate.php" method="post">
            <div class="mb-2">
                <label for="name">姓名</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
           
            <div class="mb-2">
                <label for="email">帳號(email)</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
             <div class="mb-2">
                <label for="password">密碼</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-2">
                <label for="gender">性別</label>
                <input type="text" class="form-control" name="gender" id="gender" required>
            </div>
            <div class="mb-2">
                <label for="age">年齡</label>
                <input type="text" class="form-control" name="age" id="age" required>
            </div>

            <div class="mb-2">
                <label for="phone">手機號碼</label>
                <div class="row">
                  <div class="col">
                  <input type="tel" class="form-control" name="phone" id="phone" >
                  </div>
                </div>
            </div>
            <div class="mb-2">
                <label for="address">地址</label>
                <input type="text" class="form-control" name="address" id="address" required>
            </div>


            <button type="submit" class="btn btn-info text-white">送出
            </button>
        </form>
        <div class="py-2">
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