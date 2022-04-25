<!doctype html>
<html lang="en">

<head>
  <title>新增廠商</title>
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
      height: 650px;
    }
    
</style>
</head>

<body>
  <?php require_once("../layout/ad-header.php"); ?>
  <div class="d-flex">
    <?php require_once("../layout/ad-business-sidebar.php"); ?>
    <div class="container">
      <div class="row py-3">
        賣家管理 / 新增賣家
      </div>
      <form action="doCreate.php" method="post">
        <div class="mb-3">
          <label for="name">廠商名稱</label>
          <input type="text" class="form-control" name="business_name" required>
        </div>
        <div class="mb-3">
          <label for="email">帳號(信箱)</label>
          <input type="email" id="email" class="form-control" name="account" required>
        </div>
        <div class="mb-3">
          <label for="password">密碼</label>
          <input type="password" id="password" class="form-control" name="password" required>
        </div>
        <div class="mb-3">
          <label for="phone">聯絡手機</label>
          <input type="tel" id="phone" class="form-control" name="phone" required>
        </div>
        <div class="mb-3">
          <label for="address">地址</label>
          <input type="text" class="form-control" name="address" required>
        </div>
        <div class="d-flex justify-content-end mb-3">
          <a class="btn btn-info text white mx-3" href="user-list.php">回列表</a>
          <button type="submit" class="btn btn-info">送出</button>
        </div>
      </form>
  </div>
  </div>
  <script src="sidebars.js"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>