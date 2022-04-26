<?php
require_once("../project-connect.php");

if (!isset($_GET["id"])) {
    echo "您不是從正當管道進入";
    exit;
} else {
    $order_id = $_GET["id"];
}

if (!isset($_GET["listp"])) {
    $listp = 1;
} else {
    $listp = $_GET["listp"];
}

if(isset($_GET["title"])){
    $title = $_GET["title"];
}else{
    $title = "id";
}

if (!isset($_GET["p"])) {
    $p = 1;
} else {
    $p = $_GET["p"];
}

# Order
$sqlCount = "SELECT * FROM user_order_detail WHERE order_id = '$order_id'";
$resultCount = $conn->query($sqlCount);
// $rows = $result->fetch_all(MYSQLI_ASSOC);
# 資料筆數
$total = $resultCount->num_rows;

// 每頁顯示筆數
$per_page = 3;

// CEIL 無條件進位 ； 計算共幾頁
$page_count = CEIL($total / $per_page);

// 透過 $p 控制 LIMIT 即可 控制顯示的資料範圍
$start = ($p - 1) * $per_page;

# Order Detail
$sql = "SELECT user_order_detail.*, user_order.member_num, user_order.member_name, user_order.order_date,
user_order.order_address, vendor_user.business_name, product.category, classify.classify_name, product.img
FROM user_order_detail JOIN user_order ON user_order_detail.order_id = user_order.id
JOIN vendor_user ON user_order_detail.vendor_id = vendor_user.id
JOIN product ON user_order_detail.product_id = product.id
JOIN classify ON product.classify_id = classify.id
WHERE user_order_detail.order_id = $order_id 
LIMIT $start, $per_page";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

/*刪除資料表內容*/
if (isset($_POST['delete_product'])) {
    $id = $_POST['delete_id'];
    $query2 = "DELETE FROM user_order_detail WHERE user_order_detail.product_id ='$id'";
    $query_run2 = mysqli_query($conn, $query2);
    header("location: admin-order-detail.php?id=" . $order_id);
}

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
            height: 490px;
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
    <?php require_once("../layout/ad-header.php"); ?>
    <div class="d-flex">
        <?php require_once("../layout/ad-order-sidebar.php"); ?>
        <div class="container mt-5">
            <a class="my-btn text-white py-2" href="admin-order-list.php?p=<?=$listp?>&title=<?=$title?>">回列表</a>
            <form class="mt-4 mb-3" action="admin-update-Order.php" method="post">
                <input type="hidden" name="id" value="<?= $order_id ?>">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="h3">訂單編號：<?= $order_id ?></h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="h3">訂單日期：<?= $rows[0]["order_date"] ?></h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="h3">會員編號：<?= $rows[0]["member_num"] ?></h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="h3">會員名稱：<?= $rows[0]["member_name"] ?></h2>
                    </div>
                    <div class="col-auto mt-3">
                        <h2 class="h3">地址：</h2>
                    </div>
                    <div class="col-md-4 px-0 mt-3">
                        <input class="form-control" name="address" type="text" value="<?= $rows[0]["order_address"] ?>">
                    </div>
                    <div class="col-auto mt-3">
                        <button type="submit" class="my-btn text-white">修改</button>
                    </div>
                </div>
            </form>
            <div class="text-end mb-2">
                第 <?= $p ?> 頁 , 共 <?= $page_count ?> 頁 , 共 <?= $total ?> 筆
            </div>
            <div class="table-wrap">
                <table class="table table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>廠商名稱</th>
                            <th>商品名稱</th>
                            <th>商品圖片</th>
                            <th>價錢</th>
                            <th>數量</th>
                            <th>小計</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <td><?= $row["business_name"] ?></td>
                                <td><?= $row["product_name"] ?></td>
                                <td class="d-inline-block">
                                    <div class="box">
                                        <img class="my-img-fluid" src="../../images/<?= $row["classify_name"]?>/<?=$row["category"]?>/<?=$row["img"]?>" alt="">
                                    </div>
                                </td>
                                <td>$<?= $row["price"] ?></td>
                                <td><?= $row["amount"] ?></td>
                                <td>$<?= $row["price"] * $row["amount"] ?></td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="delete_id" value="<?= $row["product_id"] ?>">
                                        <button name="delete_product" class="my-btn" onclick="javascript:return del();">刪除</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-end" colspan="6">
                                <?php
                                $total = 0;
                                $sqlMoney = "SELECT user_order_detail.*, user_order.member_num, user_order.member_name, user_order.order_date,
                                  user_order.order_address, vendor_user.business_name, product.category, classify.classify_name, product.img
                                  FROM user_order_detail JOIN user_order ON user_order_detail.order_id = user_order.id
                                  JOIN vendor_user ON user_order_detail.vendor_id = vendor_user.id
                                  JOIN product ON user_order_detail.product_id = product.id
                                  JOIN classify ON product.classify_id = classify.id
                                  WHERE user_order_detail.order_id = $order_id";
    
                                $resultMoney = $conn->query($sqlMoney);
                                $rowsMoney = $resultMoney->fetch_all(MYSQLI_ASSOC);
    
                                foreach ($rowsMoney as $row) {
                                    $subtotal = $row["price"] * $row["amount"];
                                    $total += $subtotal;
                                }
                                echo "總金額 $" . $total;
                                ?>
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <?php if ($p > 1) : ?>
                                <li class="page-item"><a class="page-link" href="admin-order-detail.php?listp=<?=$listp?>&title=<?=$title?>&id=<?= $order_id ?>&p=<?= $p - 1 ?>"><</a></li>
                            <?php endif; ?>

                            <li class="page-item active"><a class="page-link" href="admin-order-detail.php?listp=<?=$listp?>&title=<?=$title?>&id=<?= $order_id ?>&p=<?= $p ?>"><?= $p ?></a></li>

                            <?php if ($p < $page_count) : ?>
                                <li class="page-item"><a class="page-link" href="admin-order-detail.php?listp=<?=$listp?>&title=<?=$title?>&id=<?= $order_id ?>&p=<?= $p + 1 ?>">></a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

<?php $conn -> close(); ?>

    <script src="sidebars.js"></script>
       <!-- 刪除確認的JS -->
    <script type="text/javascript">
        function del(){
            var msg = "您確定要刪除嗎？\n請確認！";
            if (confirm(msg)==true){
                return true;
            }else{
                return false;
            }
        };
    </script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>