<?php



require_once("../project-connect.php");

if (!isset($_GET["p"])) {
  $p = 1;
} else {
  $p = intval($_GET["p"]);
}

if (!isset($_GET["type"])) {
  $type = 1;
} else {
  $type = $_GET["type"];
}



switch ($type) {
  case "1":
    $order = "id ASC"; //命名要改
    break;
  case "2":
    $order = "business_num ASC";
    break;
  case "3":
    $order = "business_name ASC";
    break;
  case "4":
    $order = "business_name DESC";
    break;
  default:
    $order = "id ASC";
}

//搜尋條件
if (empty($_GET["sel"]) || empty($_GET["search"])) {
  $sel = "";
  $search = "";
  $var_search = "";
} else {
  $sel = $_GET["sel"];
  $search = $_GET["search"];
  $var_search = "AND $sel LIKE '%$search%'";
}

//日期篩選
$var_DATE = "";
$var_date1 = "";
$var_date2 = "";
if (empty($_GET["date1"]) || empty($_GET["date2"])) {
  $var_DATE = "";
} else {
  $var_date1 = $_GET["date1"]." 00:00:00";
  $var_date2 = $_GET["date2"]." 23:59:59";
  $var_DATE = "AND create_time BETWEEN '$var_date1' AND '$var_date2'";
  
}

//所有使用者
$sql = "SELECT * FROM vendor_user WHERE valid=1 $var_DATE $var_search";
$result = $conn->query($sql);
$total = $result->num_rows;

$per_page = 5;
$page_count = CEIL($total / $per_page);  //CEIL無條件進位
$start = ($p - 1) * $per_page;
$user_count = $result->num_rows;


if (isset($_GET["search"])) {
  $sqlCount = "SELECT * FROM vendor_user WHERE valid=1 $var_DATE $var_search";
  $sel_result = $conn->query($sqlCount);
  $total = $sel_result->num_rows;
  $page_count = CEIL($total / $per_page);

  $sql = "SELECT * FROM vendor_user WHERE valid=1 $var_DATE $var_search
  ORDER BY $order
  LIMIT $start,$per_page";
  $result = $conn->query($sql);
  $user_count = $result->num_rows;
} else {
  $sql = "SELECT * FROM vendor_user WHERE valid=1 $var_DATE
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
    }

    .page-item.active .page-link {
      background: #DFBB8B;
      border: black;
      color: black;
    }
  </style>


</head>

<body>
  <?php require_once("../layout/ad-header.php"); ?>
  <div class="d-flex">
    <?php require_once("../layout/ad-business-sidebar.php"); ?>
    <div class="container">
      <!-- 搜尋功能 -->
      <form action="" class="my-4">
        <div class="d-flex">
          <div class="col-auto">
            <label class="col-form-label me-3">搜尋</label>
          </div>
          <select class="form-select me-3" name="sel" aria-label=".form-select-lg example">
            <option value="business_num">編號</option>
            <option value="business_name">廠商名稱</option>
            <option value="account">帳號</option>
            <option value="phone">手機</option>
          </select>
          <input type="text" class="me-3" name="search" value="<?= $search ?>">
          <div class="col-auto">
            <button type="submit" class="btn btn-info">查詢</button>
          </div>
        </div>
      </form>
      <div class="row justify-content-between pt-2">
        <div class="col-auto">
          <a class="btn btn-info text-white" href="user-list.php">全部賣家</a>
          <a class="btn btn-info text-white <?php if ($type == 2) echo "active" ?>" href="user-list.php?<?php if (empty($search)) {
                                                                                                          echo "p=" . $p . "&type=2";
                                                                                                        } else {
                                                                                                          echo "sel=" . $sel . "&search=" . $search . "&p=" . $p . "&type=2";
                                                                                                        } ?>">依編號排序</a>
          <a class="btn btn-info text-white <?php if ($type == 3) echo "active" ?>" href="user-list.php?<?php if (empty($search)) {
                                                                                                          echo "p=" . $p . "&type=3";
                                                                                                        } else {
                                                                                                          echo "sel=" . $sel . "&search=" . $search . "&p=" . $p . "&type=3";
                                                                                                        } ?>">依名稱排序</a>
        </div>
        <div class="col-auto">
          <form action="">
            <div class="row">
              
              <?php if (isset($_GET["p"])) : ?>
                     <input type="hidden" name="p" value="<?= $p ?>">
              <?php endif; ?>

              <?php if (isset($_GET["sel"]) || isset($_GET["search"])) : ?>
                <input type="hidden" name="sel" value="<?= $sel ?>">
                <input type="hidden" name="search" value="<?= $search ?>">
              <?php endif; ?>

              <?php if (isset($_GET["date1"])) : ?>
                     <input type="hidden" name="date1" value="<?= $var_date1 ?>">
              <?php endif; ?>

              <?php if (isset($_GET["date2"])) : ?>
                     <input type="hidden" name="date2" value="<?= $var_date2 ?>">
              <?php endif; ?>

              <div class="col-auto">
                <input type="date" name="date1" class="form-control">
              </div>
              <div class="col-auto">
                <label class="col-form-label" for="">~</label>
              </div>
              <div class="col-auto">
                <input type="date" name="date2" class="form-control">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-info">查詢</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row justify-content-between pt-3 align-items-center">
        <div class="col-auto">
          <a class="btn btn-info text-white" href="create-user.php">新增廠商</a>
        </div>
        <div class="col-auto">
          第 <?= $p ?> 頁, 共 <?= $page_count ?> 頁,共 <?= $total ?> 筆
        </div>
      </div>
      <div class="py-2 table-wrap">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>編號</th>
              <th>廠商名稱</th>
              <th>帳號(信箱)</th>
              <th>手機</th>
              <th>建立時間</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if ($user_count > 0) : ?>
              <?php
              foreach ($rows as $row) : ?>
                <tr>
                  <td><?= $row["business_num"] ?></td>
                  <td><?= $row["business_name"] ?></td>
                  <td><?= $row["account"] ?></td>
                  <td><?= $row["phone"] ?></td>
                  <td><?= $row["create_time"] ?></td>
                  <td><a class="btn btn-info text-white" href="user.php?id=<?= $row["id"] ?>">詳細</a></td>
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
                <li class="page-item"><a class="page-link" href="user-list.php?type=<?= $type ?>&p=<?= $p - 1 ?>&date1=<?= $var_date1?>&date2=<?=$var_date2?>&search=<?=$search?> &sel=<?=$sel?>">
                    <</a>
                </li>
              <?php endif; ?>

              <li class="page-item"><a class="page-link" href="user-list.php?type=<?= $type ?>&p=<?= $p ?>&date1=<?= $var_date1?>&date2=<?=$var_date2?>&search=<?=$search?> &sel=<?=$sel?>"><?= $p ?></a></li>

              <?php if ($p < $page_count) : ?>
                <li class="page-item"><a class="page-link" href="user-list.php?type=<?= $type ?>&p=<?= $p + 1 ?>&date1=<?= $var_date1?>&date2=<?=$var_date2?>&search=<?=$search?> &sel=<?=$sel?>">></a></li>
              <?php endif; ?>
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