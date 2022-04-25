<?php
require_once("db-connect.php");


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
    case "1";
        $order = "product_num ASC";
        break;
    case "2";
        $order = "category_id ASC";
        break;
    case "3";
        $order = "price ASC";
        break;
    case "4";
        $order = "product_num DESC";
        break;
    case "5";
        $order = "category_id DESC";
        break;
    case "6";
        $order = "price DESC";
        break;
    default:
        $order = "product_num ASC";
}


//所有使用者
$sql = "SELECT * FROM product WHERE valid=1";
$result = $conn->query($sql);
$total = $result->num_rows;


$per_page = 10;
$page_count = CEIL($total / $per_page);

//CEIL 無條件進位

$start = ($p - 1) * $per_page;

// $sql = "SELECT product.*, classify.classify_name FROM product 
// JOIN classify ON product.classify_id = classify.id WHERE product.valid=1 ORDER BY $order LIMIT $start, $per_page";

$sql = "SELECT product.*, classify.classify_name, category.category_name FROM product 
JOIN classify ON product.classify_id = classify.id 
JOIN category ON product.category_id = category.id
WHERE product.valid=1 ORDER BY $order LIMIT $start, $per_page";

// $sql = "SELECT product.*, classify.classify_name FROM product 
// ,classify WHERE `product`.`classify_id`=`classify`.`id` AND product.valid=1 ORDER BY $order LIMIT $start, $per_page";



$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
$user_count = $result->num_rows;


// $sqlClassify = "SELECT product.*, classify.classify_name FROM product 
// JOIN classify ON product.classify_id = classify.id";
// //  ORDER BY $order  LIMIT $start, $per_page";


// $resultClassify = $conn->query($sqlClassify);
// $rowsClassify = $resultClassify->fetch_all(MYSQLI_ASSOC);
// $user_count = $resultClassify->num_rows;




?>


<!doctype html>
<html lang="en">

<head>
    <title>商品管理</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .btn-check:active+.btn-info,
        .btn-check:checked+.btn-info,
        .btn-info.active,
        .btn-info:active,
        .show>.btn-info.dropdown-toggle {
            background: #aaa;
            border-color: #aaa;
        }
    </style>

</head>

<body>
    <div class="container">
        <?php //echo $order; 
        ?>
        <h1 class="text-center">商品管理</h1>
        <h6>Brand</h6>
        <div class="row">
            <div class="col-md-6">
                <div class="py-3">

                    <form action="">
                        <div class="row">

                            <div class="col-auto">
                                <label for="" class="h3">商品查詢：</label>
                            </div>
                            <div class="col-auto">
                                <select name="type" id="" class="form-control " style="width:300px">
                                    <option value="1">商品編號</option>
                                    <option value="2" selected>商品類別</option>
                                    <option value="3">金額</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-info">遞增</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-md-6">
                <div class="py-3">
                    <form action="">
                        <div class="row">
                            <div class="col-auto">
                                <select name="type" id="" class="form-control" style="width:300px">
                                    <option value="4">商品編號</option>
                                    <option value="5" selected>商品類別</option>
                                    <option value="6">金額</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-info">遞減</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="py-2 text-end">
            <a class="btn btn-info text-white" href="createproduct.php">新增商品</a>
        </div>



        <!-- <div class="row justify-content-between py-3">
      <div class="col-auto">
        <a class="btn btn-info text-white">依日期排序</a>
        <a class="btn btn-info text-white">依編號排序</a>
        <a class="btn btn-info text-white">依數量排序</a>
        <a class="btn btn-info text-white">依金額排序</a>
      </div>

    </div> -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>商品編號</th>
                    <th>商品名稱</th>
                    <th>類別</th>
                    <th>金額</th>
                    <th>庫存數量</th>
                    <th></th>


                </tr>
            </thead>

            <!-- foreach可以跑兩次迴圈 用fetch_all抓資料-->
            <tbody>
                <?php if ($user_count > 0) : ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row["product_num"] ?></td>
                            <td><?= $row["product_name"] ?></td>
                            <td><?= $row["classify_name"] ?>><?=$row["category_name"]?></td> 
                            <td><?= $row["price"] ?></td>
                            <td><?= $row["product_count"] ?></td>

                            <td><a class="btn btn-info text-white" href="product.php?id=<?= $row["id"] ?>">檢視</a></td>
                        </tr>
                    <?php endforeach ?>

                <?php else : ?>
                    <?= "no data." ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>



    <div class="py-2 ">
        <nav aria-label="Page navigation example ">
            <ul class="pagination justify-content-center ">
            <?php if ($p != 1) : ?>
              <li class="page-item"><a class="page-link" href="product_list.php?p=<?= $p - 1 ?>&type=<?= $type ?>"><</a>
              </li>
          
    
            <li class="page-item "><a class="page-link" href="product_list.php?p=<?= $p-1 ?>"><?= $p-1 ?></a></li> 
            <?php endif; ?>
            <li class="page-item active"><a class="page-link" href="product_list.php?p=<?= $p ?>"><?= $p ?></a></li>
            <?php if ($p+1 <= $page_count): ?>
            <li class="page-item "><a class="page-link" href="product_list.php?p=<?= $p+1 ?>"><?= $p+1 ?></a></li>
            <?php endif; ?>
            
            <?php if($p+2 <= $page_count): ?>
            <li class="page-item "><a class="page-link" href="product_list.php?p=<?= $p + 1 ?>&type=<?= $type ?>">></a></li>
            <?php endif; ?>
            </ul>
        </nav>

    </div>
    </ul>
    <div class="py-2 text-center">
        第<?= $p ?> 頁,共<?= $page_count ?>頁,共<?= $total ?> 筆
    </div>

    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>