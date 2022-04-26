<?php


require_once("../project-connect.php");



if (isset($_GET["sel"])) {
  $sel = $_GET["sel"];
} else {
  $sel = "";
}
if (isset($_GET["search"])) {
  $search = $_GET["search"];
} else {
  $search = "";
}
$var_search = "$sel like '%$search%'";



if (!isset($_GET["p"])) {
  $p = 1;
} else {
  $p = $_GET["p"];
}
if (!isset($_GET["type"])) {
  $type = 1;
} else {
  $type = $_GET["type"];
}

switch ($type) {
  case "1":
    $order = "member_num ASC";
    break;
  case "2":
    $order = "create_time DESC";
    break;
  case "3":
    $order = "BINARY(CONVERT(`member_name` USING big5)) ASC";
    break;

  default:
    $order = "member_num ASC";
}






$sql = "SELECT * FROM customer_user WHERE valid=1";
$result = $conn->query($sql);
$total = $result->num_rows;

$per_page = 5;
$page_count = CEIL($total / $per_page);
$start = ($p - 1) * $per_page;
$user_count = $result->num_rows;



if (isset($_GET["search"])) {
  $sql = "SELECT * FROM customer_user WHERE valid=1 AND $var_search";
  $sel_result = $conn->query($sql);
  $total = $sel_result->num_rows;
  $page_count = CEIL($total / $per_page);
  $sql = "SELECT * FROM customer_user WHERE valid=1 AND $var_search
    ORDER BY $order
    LIMIT $start,$per_page";
  $result = $conn->query($sql);

  $page_count = CEIL($total / $per_page);
  $user_count = $result->num_rows;
} else {
  $sql = "SELECT * FROM customer_user WHERE valid=1
  ORDER BY $order
  LIMIT $start,$per_page";
  $result = $conn->query($sql);

  $user_count = $result->num_rows;
}



$rows = $result->fetch_all(MYSQLI_ASSOC);



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
    .btn-check:active+.btn-info,
    .btn-check:checked+.btn-info,
    .btn-info.active,
    .btn-info:active,
    .show>.btn-info.dropdown-toggle {

      background-color: #aaa;
      border-color: #aaa;
    }

    .form-select {
      width: 30%;
    }

    .table-wrap {
      height: 540px;
    }

    .container .btn {
      background: #CA965C;
      border: #CA965C;
    }

    .page-link {
      color: black;
      border-radius: 1px;
    }

    .page-item.active .page-link {
      background: #DFBB8B;
      border-radius: 1px;
      color: black;
      border: #DFBB8B;
    }

    .pagination {
      border: black;
      border-radius: 1px;

    }

    .container {
      height: 650px;
    }
  </style>

</head>

<body>
  <?php require_once("../layout/ad-header.php"); ?>
  <div class="d-flex">
    <?php require_once("../layout/admin-customer-sidebar.php"); ?>
    <div class="container">
      <div class="py-3">
        <a href="customer-create-user.php" class="btn btn-info text-white">新增</a>
      </div>

      <div class="d-flex justify-content-between">


        <form action="" class="">
          <div class="d-flex">
            <div class="col-auto">
              <label class="col-form-label me-3">搜尋</label>
            </div>
            <select class="form-select" aria-label="Default select example" name="sel">
              <option value="member_num" <?php if ($sel == "member_num") echo "selected" ?>>會員編號</option>
              <option value="member_name" <?php if ($sel == "member_name") echo "selected" ?>>姓名</option>
              <option value="account" <?php if ($sel == "account") echo "selected" ?>>帳號</option>
            </select>

            <div class="col-auto">
              <input type="text" class="form-control" name="search" value="<?= $search ?>">
            </div>


            <div class="col-auto">
              <button type="submit" class="btn btn-info text-white">
                確認
              </button>
            </div>
          </div>
        </form>





        <div class="text-end">
          <a class="btn btn-info text-white <?php if ($type == 1) echo "active" ?>" href="customer-user-list.php?<?php if (empty($search)) {
                                                                                                                    echo "p=" . $p . "&type=1";
                                                                                                                  } else {
                                                                                                                    echo "sel=" . $sel . "&search=" . $search . "&p=" . $p . "&type=1";
                                                                                                                  } ?>">依編號排序</a>
          <a class="btn btn-info text-white <?php if ($type == 2) echo "active" ?>" href="customer-user-list.php?<?php if (empty($search)) {
                                                                                                                    echo "p=" . $p . "&type=2";
                                                                                                                  } else {
                                                                                                                    echo "sel=" . $sel . "&search=" . $search . "&p=" . $p . "&type=2";
                                                                                                                  } ?>">依日期排序</a>
          <a class="btn btn-info text-white <?php if ($type == 3) echo "active" ?>" href="customer-user-list.php?<?php if (empty($search)) {
                                                                                                                    echo "p=" . $p . "&type=3";
                                                                                                                  } else {
                                                                                                                    echo "sel=" . $sel . "&search=" . $search . "&p=" . $p . "&type=3";
                                                                                                                  } ?>">依名字排序</a>

        </div>


      </div>
      <div class="d-flex justify-content-between">
        <div class="">
          <a href="customer-user-list.php" class="btn btn-info text-white my-3">全部會員</a>
        </div>
        <div class="py-2 my-3">
          第 <?= $p ?> 頁 , 共 <?= $page_count ?> 頁 , 共 <?= $total ?> 筆
        </div>

      </div>



      <div class="table-wrap">
        <table class="table table-bordered">
          <thead>
            <th>會員編號</th>
            <th>姓名</th>
            <th>帳號</th>
            <th>建立日期</th>
            <th></th>
          </thead>
          <tbody>
            <?php if ($user_count > 0) : ?>
              <?php foreach ($rows as $row) : ?>
                <tr>
                  <td><?= $row["member_num"] ?></td>
                  <td><?= $row["member_name"] ?></td>
                  <td><?= $row["account"] ?></td>
                  <td><?= $row["create_time"] ?></td>
                  <td class="text-center"><a class="btn btn-info text-white" href="customer-user.php? id=<?= $row["id"] ?>">詳細</a></td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <?= "no data." ?>
            <?php endif; ?>


          </tbody>
        </table>

      </div>


      <div class="py-2 d-flex justify-content-center">
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <?php if ($p > 1) : ?>
              <li class="page-item"><a class="page-link" href="customer-user-list.php?<?php if (empty($search)) {
                                                                                        echo "p=" . ($p - 1) . "&type=" . $type;
                                                                                      } else {
                                                                                        echo "sel=" . $sel . "&search=" . $search . "&p=" . ($p - 1) . "&type=" . $type;
                                                                                      } ?>">
                  <</a>
              </li>
            <?php endif; ?>

            <li class="page-item"><a class="page-link" href="customer-user-list.php?type=<?= $type ?>&p=<?= $p ?>"><?= $p ?></a></li>

            <?php if ($p < $page_count) : ?>
              <li class="page-item"><a class="page-link" href="customer-user-list.php?<?php if (empty($search)) {
                                                                                        echo "p=" . ($p + 1) . "&type=" . $type;
                                                                                      } else {
                                                                                        echo "sel=" . $sel . "&search=" . $search . "&p=" . ($p + 1) . "&type=" . $type;
                                                                                      } ?>">></a></li>
            <?php endif; ?>
          </ul>
        </nav>

        </ul>
        </nav>
      </div>

    </div>
  </div>



  <script src="sidebars.js"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>