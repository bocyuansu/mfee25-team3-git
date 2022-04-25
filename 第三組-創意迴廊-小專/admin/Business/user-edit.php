<?php

if (!isset($_GET["id"])) {
  header("location: 404.php");
}

$id = $_GET["id"];

require_once("../project-connect.php");
$sql = "SELECT * FROM vendor_user WHERE id='$id' AND valid=1";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
if (!$row) {
  header("location: 404.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>廠商編輯</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.0.2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/ad-css.css">
  <style>
    .table-wrap {
      height: 540px;
    }

    .container .btn {
      background: #CA965C;
      border: #CA965C;
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
      <div class="row justify-content-center">
        <div class="col-lg-4 my-3">
          <form action="updateUser.php" method="post">
            <table class="table table-bordered ">
              <input type="hidden" name="id" value="<?= $row["id"] ?>">
              <tr>
                <th>id</th>
                <td><?= $row["id"] ?></td>
              </tr>
              <tr>
                <th>name</th>
                <td><input class="form-control" name="business_name" type="text" value="<?= $row["business_name"] ?>"></td>
              </tr>
              <tr>
                <th>email</th>
                <td><input class="form-control" name="account" type="email" value="<?= $row["account"] ?>"></td>
              </tr>
              <tr>
                <th>phone</th>
                <td><input class="form-control" name="phone" type="tel" value="<?= $row["phone"] ?>"></td>
              </tr>
              <tr>
                <th>create time</th>
                <td><?= $row["create_time"] ?></td>
              </tr>
            </table>
            <div class="py-2">
              <button type="submit" class="btn btn-info text=white">儲存</button>
              <a class="btn btn-info text-white" href="user.php?id=<?= $row["id"] ?>">取消</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>