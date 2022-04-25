<?php
require_once("../project-connect.php");

if (!isset($_GET["p"])) { // p是指page
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
        $order = "id ASC";
        break;
    case "2":
        $order = "id DESC";
        break;
    default:
        $order = "id ASC";
}
// ASC:升冪、DESC:降冪

// 所有使用者
$classify_id = $_GET["classify_id"];
// $classify_name =  $_GET["classify_name"];
$sql = "SELECT * FROM category WHERE valid=1 AND classify_id = $classify_id"; //修改成你要的SQL語法,WHERE:選取匹配指定條件的數據
$result = $conn->query($sql); // query:引用資料 $conn:連結
$total = $result->num_rows; //總共有幾筆
$per_page = 4; //每頁顯示項目數量
$page_count = CEIL($total / $per_page); // SQL中的取整函數:將最後結果的餘數取正數
$start = ($p - 1) * $per_page; // 最開始從最0筆資料開始,所以(頁數-1)*每頁顯示項目數量

if (isset($_GET["classify_id"])) {
    // 資料表合併:代表同欄位的資料JOIN在一起
    // 選取 資料表A.*,資料表B.* 從資料表A
    // JOIN 資料表B ON 資料表A.classify_id欄位= 資料表B.id欄位
    $classify_id = $_GET["classify_id"];
    $sql = "SELECT classify.classify_name, category.*  FROM 
    classify JOIN category ON classify.id = category.classify_id
    WHERE classify_id = $classify_id
    AND category.valid=1 
     ORDER BY $order
    LIMIT $start,$per_page
    ";


    $result = $conn->query($sql);
    $category_count = $result->num_rows; //總共有幾筆
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $page_count = CEIL($total / $per_page);
    $start = ($p - 1) * $per_page;



    // h1抓值的方法一
    // 直接使用sql抓classify資料表，指定id = $classify_id (這裡的$classify_id是使用上面if (isset($_GET["classify_id"]))裡面的)
    // 然後在下面第142-146行寫if (isset($_GET["classify_id"]))判斷式
    // 並且在admin-classify-edit.php/admin-classify-doCreate.php這兩個PHP檔內重複做這件事
    $sql_classify_id = "SELECT * FROM classify
    WHERE id = $classify_id";
    $sql_result = $conn->query($sql_classify_id);
    $classify_id_value = $sql_result->fetch_all(MYSQLI_ASSOC);
    // var_dump($classify_id_value);

    // h1抓值的方法二 (將值印在網址上，再拿下來用，缺點：網址上有中文，在轉碼時可能會造成網址上出現一堆亂碼)
    // 從admin-classify.php的詳細按鈕href後面加 &classify_name=<?= $row["classify_name"] 將值傳過來 admin-category.php這層
    // 在admin-category.php這層上面加 $classify_name =  $_GET["classify_name"]; 來抓上一頁傳過來的值
    // 並在admin-category.php/admin-category-edit.php/admin-category-doCreate.php這三個檔案內
    // 最上面都加 $classify_name = $_GET["classify_name"]; 來抓值  **(如使用POST傳值，下一層就用POST接)
    // 並在每個有關連的php檔中，將每個按鈕href及location的最後面都加上 &classify_name=<?= $row["classify_name"] 來抓值
    // 然後在下面第142-146行寫if (isset($_GET["classify_id"]))判斷式
    // <h1>裡面 $classify_id_value[0]["classify_name"] 改放 $classify_name


} else {
    header("location: admin-classify.php");
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .btn-check:active+.btn-info,
        .btn-check:checked+.btn-info,
        .btn-info.active,
        .btn-info:active,
        .show>.btn-info.dropdown-toggle {
            background-color: #CCC;
            border-color: #aaa;
        }

        .table-wrap {
            height: 540px;
        }

        .container .btn {
            background: #CA965C;
            border: #CA965C;
        }

        .container .page {
            background: #DFBB8B;
            border: #DFBB8B;
        }

        .page-item.active .page-link {
            background: #DFBB8B;
            border: black;
            color: black;
        }

        h1 {
            color: #4F345A;
        }
    </style>
</head>

<body>
    <?php require_once("../layout/ad-header.php"); ?>
    <div class="d-flex">
        <?php require_once("../layout/ad-classify-sidebar.php"); ?>
        <div class="container">
            <div class="justify-content-between mx-auto table-wrap">
                <div class="text-start">
                    <a class="btn btn-info text-white me-3 mt-3" href="../Classify/admin-classify.php?type=1&classify_id=<?= $classify_id ?>">回總分類列表</a>
                </div>
                <?php if (isset($_GET["classify_id"])) : ?>
                    <div class="mt-3">
                        <h1 class="my-0"><?= $classify_id_value[0]["classify_name"] ?></h1>
                    </div>
                <?php endif; ?>
                <div class="text-start">
                    <div class="d-flex justify-content-between">
                        <div class="text-start mt-3">
                            <a class="btn btn-info text-white me-3 <?php if ($type == 1) echo "active" ?>" href="admin-category.php?type=1&classify_id=<?= $classify_id ?>&p=<?= $p ?>">遞增</a>
                            <a class="btn btn-info text-white me-3 <?php if ($type == 2) echo "active" ?>" href="admin-category.php?type=2&classify_id=<?= $classify_id ?>&p=<?= $p ?>">遞減</a>
                            <a class="btn btn-info text-white" href="admin-category-doCreate.php?classify_id=<?= $classify_id ?>">新增類別</a>
                        </div>
                        <div class="py-2 d-flex d-inline text-end my-3">
                            共 <?= $total ?> 筆
                        </div>
                    </div>
                </div>

                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>刪除</th>
                            <th>編輯</th>
                            <th>類別ID</th>
                            <th>類別名稱</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($category_count > 0) : ?>
                            <?php
                            for ($i = 0; $i < count($rows); $i++) :
                                $row = $rows[$i];
                            ?>
                                <tr class="align-middle text-center">
                                    <td><a class="p-2 text-decoration-none" style="color: #212529;" href='admin-category-doDelete-program.php?id=<?= $row["id"] ?>&classify_id=<?= $classify_id ?>'><i class="fa-solid fa-calendar-xmark"></i> 刪除</a></td>
                                    <td><a class="p-2 text-decoration-none text-black" style="color: #212529;" href='admin-category-edit.php?id=<?= $row["id"] ?>&classify_id=<?= $classify_id ?>'><i class="fa-solid fa-pen-to-square"></i> 編輯</a></td>
                                    <td><?= $row["id"] ?></td>
                                    <!-- 
                                        如果要重新將頁面順序重新定義,就把 $row["id"] 改成 $i + 1 + ($p - 1) * $per_page
                                        這樣畫面上就不會以資料庫id號碼顯示，而是以新的流水碼順序顯示
                                        但遞增遞減按了還是會以之前設定的id值做遞增遞減
                                        所以如果要讓他以新定義的id值做排序，上面就要整個重新設定條件
                                        但因為這裡的原資料庫category.id是有意義且可看出新舊關係
                                        所以不建議為了順眼重新定義id流水號，因為沒有意義
                                    -->
                                    <td><?= $row["category_name"] ?></td>
                                </tr>
                            <?php endfor; ?>
                        <?php else : ?>
                            <?= "no data." ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="row py-2">
                    <div class="col">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <!--此段為檢測是否顯示上一頁按鈕 -->
                                <?php if ($p > 1) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="../Category/admin-category.php?p=<?= $p - 1 ?>&type=<?= $type ?>&classify_id=<?= $classify_id ?>">
                                            <</a>
                                    </li>
                                <?php endif; ?>
                                <!--此段為當前頁按鈕 -->
                                <li class="page-item"><button class="page-link" href=""><?= $p ?></button></li>

                                <!--此段為檢測是否顯示下一頁按鈕 -->
                                <?php if ($p < $page_count) : ?>
                                    <li class="page-item"><a class="page-link" href="../Category/admin-category.php?p=<?= $p + 1 ?>&type=<?= $type ?>&classify_id=<?= $classify_id ?>">></a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="sidebars.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>