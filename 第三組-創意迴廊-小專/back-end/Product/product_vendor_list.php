<?php
require_once("../project-connect.php");

if(!isset($_SESSION["user"])){
    header("location: ../Login/back-end-login.php");
    exit;
}

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


if (empty($_GET["vendor_id"])) {
    $vendor_id = $_SESSION["user"]["id"];
    $sql = "SELECT * FROM product WHERE product.valid=1";
    $result = $conn->query($sql);
    $total = $result->num_rows;
} else {

    //所有使用者

    $vendor_id = $_GET["vendor_id"];
    $sql = "SELECT * FROM product WHERE product.vendor_id = '$vendor_id' AND product.valid=1";
    $result = $conn->query($sql);
    $total = $result->num_rows;
}

$per_page = 5;
$page_count = CEIL($total / $per_page);

//CEIL 無條件進位

$start = ($p - 1) * $per_page;

// $sql = "SELECT product.*, classify.classify_name FROM product 
// JOIN classify ON product.classify_id = classify.id WHERE product.valid=1 ORDER BY $order LIMIT $start, $per_page";
if (empty($_GET["vendor_id"])) {
    $sql = "SELECT product.*, classify.classify_name, category.category_name, vendor_user.business_name FROM product 
    JOIN classify ON product.classify_id = classify.id 
    JOIN category ON product.category_id = category.id
    JOIN vendor_user ON product.vendor_id = vendor_user.id
    WHERE product.vendor_id ='$vendor_id' AND product.valid=1 ORDER BY $order LIMIT $start, $per_page";
    
    $sqlCount = "SELECT product.*, classify.classify_name, category.category_name, vendor_user.business_name FROM product 
    JOIN classify ON product.classify_id = classify.id 
    JOIN category ON product.category_id = category.id
    JOIN vendor_user ON product.vendor_id = vendor_user.id
    WHERE product.vendor_id ='$vendor_id' AND product.valid=1 ORDER BY $order ";

    $resultCount = $conn->query($sqlCount);
    $total = $resultCount->num_rows;
    $page_count = CEIL($total / $per_page);

} else {
    $sql = "SELECT product.*, classify.classify_name, category.category_name, vendor_user.business_name FROM product 
    JOIN classify ON product.classify_id = classify.id 
    JOIN category ON product.category_id = category.id
    JOIN vendor_user ON product.vendor_id = vendor_user.id
    WHERE product.vendor_id ='$vendor_id' AND product.valid=1 ORDER BY $order LIMIT $start, $per_page";

}

// $sql = "SELECT product.*, classify.classify_name FROM product 
// ,classify WHERE `product`.`classify_id`=`classify`.`id` AND product.valid=1 ORDER BY $order LIMIT $start, $per_page";

// 假設我們有做模糊搜尋
if (isset($_GET["searchType"]) && isset($_GET["searchInput"])) {

    $searchType = $_GET["searchType"];
    $searchInput = $_GET["searchInput"];
    $sql = "SELECT product.*, classify.classify_name, category.category_name, vendor_user.business_name FROM product 
    JOIN classify ON product.classify_id = classify.id 
    JOIN category ON product.category_id = category.id
    JOIN vendor_user ON product.vendor_id = vendor_user.id
    WHERE product.vendor_id ='$vendor_id' AND $searchType LIKE '%$searchInput%' 
    ORDER BY $order LIMIT $start, $per_page";
    // $vendor_id = $_GET["vendor_id"];

    $sqlCount = "SELECT * FROM product WHERE product.vendor_id = '$vendor_id' AND $searchType LIKE '%$searchInput%' AND product.valid=1 
    ORDER BY $order";
    $resultCount = $conn->query($sqlCount);
    $total = $resultCount->num_rows;
    $page_count = CEIL($total / $per_page);

}


// 假設我們有設定上下架
if (isset($_GET["valid"])) {
    $valid = $_GET["valid"];
    $sql = "SELECT product.*, classify.classify_name, category.category_name, vendor_user.business_name FROM product 
    JOIN classify ON product.classify_id = classify.id 
    JOIN category ON product.category_id = category.id
    JOIN vendor_user ON product.vendor_id = vendor_user.id
    WHERE  product.vendor_id ='$vendor_id' AND product.shelf = $valid ORDER BY $order LIMIT $start, $per_page";
    
    $sqlCount = "SELECT * FROM product WHERE product.vendor_id = '$vendor_id' AND product.shelf = $valid AND product.valid=1 
    ORDER BY $order";
    $resultCount = $conn->query($sqlCount);
    $total = $resultCount->num_rows;
    $page_count = CEIL($total / $per_page);

}



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

    <link rel="stylesheet" href="../css/be-css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .table-wrap {
            height: 500px;
        }

        .page-item.active .page-link {
            background: #DFBB8B;
            color: black;
        }

        .page-link {
            color: black;
            border:  #DFBB8B ;
            
        }

        .btn-info {
        color: #fff;
        background-color: #CA965C;
        border-color: #CA965C;
        }

        .brand{
            font-size: 40px;
            color:#CA965C;
            text-decoration: none;
        }

        .brand:hover{
          
            color:#F4DFBA;
           
        }
        .btn-info:hover{
            background-color: #F4DFBA;
            border-color: #F4DFBA;
        }   

        .btn-create{
            background-color: #B47157;
        }

    </style>


</head>


<body>

    <?php require_once("../layout/be-header.php"); ?>
    <div class="d-flex">
        <?php require_once("../layout/be-product-sidebar.php"); ?>
        <div class="container mt-3">

            <?php //echo $order; 
            ?>

            <h1 class="text-center">商品管理</h1>
            <a href="product_vendor_list.php "class="brand">
                <?php 
                    $sqlBus = "SELECT * FROM product WHERE vendor_id = '$vendor_id'";
                    $resultBus = $conn->query($sqlBus);
                    $rowsBus = $resultBus->fetch_all(MYSQLI_ASSOC);
                    echo $rowsBus[0]["product_brand"];
                    // if (!isset($rows[0]["business_name"])) {
                    //     echo "123 ";
                    // } else {
                    //     echo $rows[0]["business_name"];
                    // } 
                ?>
            </a>
            <div class="row">
                <div class="col-md-3">
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <form action="" class="py-3">
                            <div class="row">
                                <?php if (isset($_GET["p"])) : ?>
                                    <input type="hidden" name="p" value=<?= $p ?>>
                                <?php endif; ?>
                                <?php if (isset($_GET["vendor_id"])) : ?>
                                    <input type="hidden" class="d-none" name="vendor_id" value="<?= $_GET["vendor_id"] ?>">
                                <?php endif; ?>

                                <div class="col-auto">
                                    <select name="type" id="" class="form-control " style="width:150px">
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


                <div class="col-md-3">
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <form action="" class="py-3">
                            <div class="row">
                                <?php if (isset($_GET["p"])) : ?>
                                    <input type="hidden" name="p" value=<?= $p ?>>
                                <?php endif; ?>
                                <?php if (isset($_GET["vendor_id"])) : ?>
                                    <input type="hidden" class="d-none" name="vendor_id" value="<?= $_GET["vendor_id"] ?>">
                                <?php endif; ?>

                                <div class="col-auto">
                                    <select name="type" id="" class="form-control" style="width:150px">
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

                <!-- 模糊搜尋 -->
                <div class="col-md-3">
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <form class="py-3" action="./product_vendor_list.php" method="get">
                            <?php if (isset($_GET["vendor_id"])) : ?>
                                    <input type="hidden" class="d-none" name="vendor_id" value="<?= $_GET["vendor_id"] ?>">
                            <?php endif; ?>

                            <div class="d-flex ">
                                <div class="me-2">
                                    <select class="form-control round-0 border-0 border-bottom w-auto" name="searchType" id="searchType">
                                        <option disabled <?php if (!isset($_GET["searchType"]) || !isset($_GET["searchInput"])) : ?>selected<?php endif; ?>>搜索類型</option>
                                        <option value="product_num" <?php if (isset($_GET["searchType"]) && isset($_GET["searchInput"])) : ?><?= ($searchType == '' ? 'selected' : '') ?><?php endif; ?>>編號</option>
                                        <option value="product_name" <?php if (isset($_GET["searchType"]) && isset($_GET["searchInput"])) : ?><?= ($searchType == 'product_name' ? 'selected' : '') ?><?php endif; ?>>名稱</option>
                                    </select>
                                </div>
               


                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchInput" placeholder="search" name="searchInput" <?php if (isset($_GET["searchType"]) && isset($_GET["searchInput"])) : ?>value="<?= $searchInput ?>" <?php endif; ?>>
                                    <button class="btn btn-info round-0" type="submit" id="searchBtn">搜尋</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- 上下架搜尋 -->
                <div class="col-md-3">
                    <div class="d-flex justify-content-end align-items-center mt-4 ms-3">
                        <form class="py-3" action="./product_vendor_list.php" method="get">
                            <?php if (isset($_GET["vendor_id"])) : ?>
                                <input type="hidden" class="d-none" name="vendor_id" value="<?= $_GET["vendor_id"] ?>">
                            <?php endif; ?>

                            <div class="d-flex ">
                                <div class="">
                                    <select class="form-control round-0 border-0 border-bottom w-auto" name="valid" id="valid">
                                        <option disabled <?php if (!isset($_GET["valid"]) || !isset($_GET["valid"])) : ?>selected<?php endif; ?>>上架類型</option>
                                        <option value="1" <?php if (isset($_GET["valid"])) : ?><?= ($valid == '1' ? 'selected' : '') ?><?php endif; ?>>上架中</option>
                                        <option value="0" <?php if (isset($_GET["valid"])) : ?><?= ($valid == '0' ? 'selected' : '') ?><?php endif; ?>>下架中</option>
                                    </select>
                                </div>
                                
                                <div class="input-group ms-3">
                                    <button class="btn btn-info round-0" type="submit" id="searchBtn">搜尋</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="py-2 text-end">
                <a class="btn btn-create text-white" href="
                <?php 
                if (isset($_GET["vendor_id"])) {
                    $vendor_id = $_GET["vendor_id"];
                    echo "createproduct.php?vendor_id=$vendor_id";
                }else{
                    echo "createproduct.php?vendor_id=1";
                } 
                ?>"><i class="fa-solid fa-plus"></i> 新增商品</a>
            </div>






            <!-- <div class="row justify-content-between py-3">
      <div class="col-auto">
        <a class="btn btn-info text-white">依日期排序</a>
        <a class="btn btn-info text-white">依編號排序</a>
        <a class="btn btn-info text-white">依數量排序</a>
        <a class="btn btn-info text-white">依金額排序</a>
      </div>

    </div> -->
    <div class="py-2 text-end">
                    第<?= $p ?> 頁,共<?= $page_count ?>頁,共<?= $total ?> 筆
                </div>

            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th style="width:100px;">商品編號</th>
                        <th style="width:300px;">商品名稱</th>
                        <th style="width:300px;">類別</th>
                        <th style="width:150px;">金額</th>
                        <th style="width:150px;">庫存數量</th>
                        <th style="width:150px;">上下架</th>
                        <th style="width:150px;"></th>


                    </tr>
                </thead>

                <!-- foreach可以跑兩次迴圈 用fetch_all抓資料-->
                <tbody>
                    <?php if ($user_count > 0) : ?>
                        <?php foreach ($rows as $row) : ?>
                            <?php
                            $shelf = "已下架";
                            if ($row["shelf"] == 1) {
                                $shelf = "上架中";
                            } ?>
                            <tr>
                                <td><?= $row["product_num"] ?></td>
                                <td><?= $row["product_name"] ?></td>
                                <td><?= $row["classify_name"] ?>><?= $row["category_name"] ?></td>
                                <td><?= $row["price"] ?></td>
                                
                                <?php 
                                    if ($row["product_count"] ==0){
                                        echo "<td style=color:red;>" . "請補貨" . "</td>";
                                    }else{
                                        echo "<td>" . $row["product_count"] ."</td>" ;
                                    }
                                ?>
                                
                                <td><?= $shelf ?></td>
                                <td><a class="btn btn-info text-white" href="product.php?vendor_id=<?= $vendor_id ?>&id=<?= $row["id"] ?>">檢視</a></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <?= "沒有相關資訊" ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col">
                    <nav aria-label="Page navigation example ">
                        <ul class="pagination justify-content-center mt-5">
    
                            <?php if ($p > 1) : ?>
    
                                <li class="page-item "><a class="page-link" href="product_vendor_list.php?vendor_id=<?= $vendor_id ?>&p=<?= $p - 1 ?>&type=<?= $type ?>">
                                        <</a>
                                </li>
                                </li>
    
                                <li class="page-item "><a class="page-link " href="product_vendor_list.php?vendor_id=<?= $vendor_id ?>&p=<?= $p - 1 ?>&type=<?= $type ?>"><?= $p - 1 ?></a></li>
                            <?php endif; ?>
                            <li class="page-item active"><a class="page-link" href="product_vendor_list.php?vendor_id=<?= $vendor_id ?>&p=<?= $p ?>&type=<?= $type ?>"><?= $p ?></a></li>
                            <?php if ($p + 1 <= $page_count) : ?>
                                <li class="page-item "><a class="page-link" href="product_vendor_list.php?vendor_id=<?= $vendor_id ?>&p=<?= $p + 1 ?>&type=<?= $type ?>"><?= $p + 1 ?></a></li>
                            <?php endif; ?>
    
                            <?php if ($p + 2 <= $page_count) : ?>
                                <li class="page-item "><a class="page-link" href="product_vendor_list.php?vendor_id=<?= $vendor_id ?>&p=<?= $p + 1 ?>&type=<?= $type ?>">></a></li>
    
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>



        


    </div>




    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../sidebars.js"></script>
</body>

</html>