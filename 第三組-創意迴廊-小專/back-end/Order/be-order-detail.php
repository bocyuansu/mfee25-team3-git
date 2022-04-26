<?php
require_once("../project-connect.php");

// 必須修改 vendor_id 
if(!isset($_SESSION["user"])){
   header("location: ../Login/back-end-login.php");
   exit;
}else{
   $vendor_id = $_SESSION["user"]["id"];
}

$business_name = $_SESSION["user"]["business_name"];

if (!isset($_GET["order_id"])) {
   echo "您不是從正當管道進入";
   exit;
} else {
   $order_id = $_GET["order_id"];
}


if (isset($_GET["title"])) {
   $title = $_GET["title"];
} else {
   $title = "product_name";
}

if (!isset($_GET["type"])) {
   $type = 1;
} else {
   $type = $_GET["type"];
}

// 依照 type 升羃 或 降冪
switch ($type) {
   case "1":
      $order = "product.product_name ASC";
      break;
   case "2":
      $order = "user_order_detail.price ASC";
      break;
   case "3":
      $order = "user_order_detail.amount ASC";
      break;
   case "4":
      $order = "user_order_detail.subtotal ASC";
      break;
   case "5":
      $order = "product.product_name DESC";
      break;
   case "6":
      $order = "user_order_detail.price DESC";
      break;
   case "7":
      $order = "user_order_detail.amount DESC";
      break;
   case "8":
      $order = "user_order_detail.subtotal DESC";
      break;
   default:
      $order = "product.product_name ASC";
}

if (!isset($_GET["p"])) {
   $p = 1;
} else {
   $p = $_GET["p"];
}

# Vendor Order List 
$sqlCount = "SELECT user_order_detail.* FROM user_order_detail 
JOIN user_order ON user_order_detail.order_id = user_order.id
WHERE user_order_detail.order_id = $order_id AND user_order_detail.vendor_id = '$vendor_id'";
$resultCount = $conn->query($sqlCount);
# 資料筆數
$total = $resultCount->num_rows;

// 每頁顯示筆數
$per_page = 3;

// CEIL 無條件進位 ； 計算共幾頁
$page_count = CEIL($total / $per_page);

// 透過 $p 控制 LIMIT 即可 控制顯示的資料範圍
$start = ($p - 1) * $per_page;



# Order
$sql = "SELECT user_order_detail.*, vendor_user.business_name, product.img, product.category, classify.classify_name
FROM user_order_detail
JOIN vendor_user ON user_order_detail.vendor_id = vendor_user.id
JOIN product ON user_order_detail.product_id = product.id
JOIN classify ON product.classify_id = classify.id
WHERE user_order_detail.order_id = $order_id AND user_order_detail.vendor_id = '$vendor_id'
ORDER BY $order
LIMIT $start, $per_page";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

?>


<!doctype html>
<html lang="en">

<head>
   <title>訂單編號 <?=$order_id?></title>
   <link rel="stylesheet" href="../css/be-css.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <style>
      .box{
          width: 100px;
          height: 100px;
      }
      .d-inline-block{
          border: 0;
      }
      .my-img-fluid{
          width: 100%;
          height: 100%;
      }
      .table-wrap{
         height: 500px;
      }
      .my-btn{
         font-size: 16px;
         padding: 6px 12px;
         color: #FFF;
         background-color: #CA965C;
         border: 0;
         border-radius: 0.25rem;
         text-decoration: none;
      }
      .page-item.active .page-link{
            background: #DFBB8B;
            border: #DFBB8B;
            color: black;
      }
      .page-link{
            color: black;
            border:  #DFBB8B;
      }

   </style>

</head>

<body>
   <?php require_once("../layout/be-header.php"); ?>
   <div class="d-flex">
      <?php require_once("../layout/be-order-sidebar.php"); ?>
      <div class="container mt-5">
         <a class="my-btn text-white py-2 my-3" href="be-order-list.php">回列表</a>
         <div class="row mt-4">
            <h2>廠商：<?= $business_name ?></h2>
            <div class="col-md-4">
               <div class="py-2">
                  <form action="">
                     <div class="row">
                        <div class="col-auto">
                           <label for="" class="h3">排序：</label>
                        </div>
                        <div class="col-auto">
                           <?php if (isset($_GET["order_id"])) : ?>
                              <input type="hidden" name="order_id" value="<?= $order_id ?>">
                           <?php endif; ?>
                           <select name="type" id="" class="form-control">
                              <option value="1" <?php if ($type == 1) : echo "selected" ?><?php endif; ?>>商品名稱</option>
                              <option value="2" <?php if ($type == 2) : echo "selected" ?><?php endif; ?>>價錢</option>
                              <option value="3" <?php if ($type == 3) : echo "selected" ?><?php endif; ?>>數量</option>
                              <option value="4" <?php if ($type == 4) : echo "selected" ?><?php endif; ?>>小計</option>
                           </select>
                        </div>
                        <div class="col-auto">
                           <button type="submit" class="my-btn">遞增排序</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-md-4">
               <div class="py-2">
                  <form action="">
                     <div class="row">
                        <div class="col-auto">
                           <?php if (isset($_GET["order_id"])) : ?>
                              <input type="hidden" name="order_id" value="<?= $order_id ?>">
                           <?php endif; ?>
                           <select name="type" id="" class="form-control">
                              <option value="5" <?php if ($type == 5) : echo "selected" ?><?php endif; ?>>商品名稱</option>
                              <option value="6" <?php if ($type == 6) : echo "selected" ?><?php endif; ?>>價錢</option>
                              <option value="7" <?php if ($type == 7) : echo "selected" ?><?php endif; ?>>數量</option>
                              <option value="8" <?php if ($type == 8) : echo "selected" ?><?php endif; ?>>小計</option>
                           </select>
                        </div>
                        <div class="col-auto">
                           <button type="submit" class="my-btn">遞減排序</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <h2 class="h3">訂單編號：<?= $order_id ?></h2>
            <div class="py-2 text-end">
               第 <?= $p ?> 頁 , 共 <?= $page_count ?> 頁 , 共 <?= $total ?> 筆
            </div>
         </div>
         <div class="table-wrap">
            <table class="table table-bordered text-center align-middle">
               <thead>
                  <tr>
                     <th>商品名稱</th>
                     <th>商品圖片</th>
                     <th>價錢</th>
                     <th>數量</th>
                     <th>小計</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($rows as $row) : ?>
                     <tr>
                        <td><?= $row["product_name"] ?></td>
                        <td class="d-inline-block">
                           <div class="box">
                              <img class="my-img-fluid" src="../../images/<?= $row["classify_name"] ?>/<?= $row["category"] ?>/<?= $row["img"] ?>" alt="">
                           </div>
                        </td>
                        <td><?= $row["price"] ?></td>
                        <td><?= $row["amount"] ?></td>
                        <td><?= $row["subtotal"] ?></td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
               <tfoot>
                  <tr>
                     <td class="text-end" colspan="5">
                        <?php
                        $total = 0;
                        $sqlMoney = "SELECT user_order_detail.*, vendor_user.business_name, product.img, product.category, classify.classify_name
                               FROM user_order_detail
                               JOIN vendor_user ON user_order_detail.vendor_id = vendor_user.id
                               JOIN product ON user_order_detail.product_id = product.id
                               JOIN classify ON product.classify_id = classify.id
                               WHERE user_order_detail.order_id = $order_id AND user_order_detail.vendor_id = '$vendor_id'
                               ORDER BY $order";
   
                        $resultMoney = $conn->query($sqlMoney);
                        $rowsMoney = $resultMoney->fetch_all(MYSQLI_ASSOC);
   
                        foreach ($rowsMoney as $row) {
                           $subtotal = $row["price"] * $row["amount"];
                           $total += $subtotal;
                        }
                        echo "總金額 $" . $total;
                        ?>
                     </td>
                  </tr>
               </tfoot>
            </table>
         </div>
         <div class="row">
            <div class="col">
               <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
                     <?php if ($p > 1) : ?>
                        <li class="page-item"><a class="page-link" href="be-order-detail.php?order_id=<?= $order_id ?>&type=<?= $type ?>&p=<?= $p - 1 ?>"><</a>
                        </li>
                     <?php endif; ?>

                     <li class="page-item active"><a class="page-link" href="be-order-detail.php?order_id=<?= $order_id ?>&type=<?= $type ?>&p=<?= $p ?>"><?= $p ?></a></li>

                     <?php if ($p < $page_count) : ?>
                        <li class="page-item"><a class="page-link" href="be-order-detail.php?order_id=<?= $order_id ?>&type=<?= $type ?>&p=<?= $p + 1 ?>">></a></li>
                     <?php endif; ?>
                  </ul>
               </nav>
            </div>
         </div>

      </div>
   </div>

<?php $conn -> close(); ?>

   <!-- 刪除確認的JS -->
   <script type="text/javascript">
      function del() {
         var msg = "您確定要刪除嗎？\n請確認！";
         if (confirm(msg) == true) {
            return true;
         } else {
            return false;
         }
      };
   </script>

   <script src="../sidebars.js"></script>
</body>

</html>