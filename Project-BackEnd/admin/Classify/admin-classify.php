<?php
require_once("../project-connect.php");

if (!isset($_GET["classifyP"])) {
    $classifyP = 1;
} else {
    $classifyP = $_GET["classifyP"];
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
$sql = "SELECT * FROM classify WHERE valid=1";
$result = $conn->query($sql);
$total = $result->num_rows; //總共要幾頁

$per_page = 4;
$page_count = CEIL($total / $per_page);
$start = ($classifyP - 1) * $per_page;

$sql = "SELECT * FROM classify WHERE valid=1 ORDER BY $order LIMIT $start,$per_page";
$result = $conn->query($sql);
$classify_count = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($rows);

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
        .table-wrap{
            height: 540px;
        }
        .container .btn{
            background: #CA965C;
            border: #CA965C;
        }        
        .container .nav{
            background-color: #DFBB8B;
            background: #DFBB8B;
            border: #DFBB8B;
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
        <?php require_once("../layout/ad-classify-sidebar.php"); ?>
        <div class="container">
            <div class="table-wrap">                
                <div class="text-start">
                    <div class="d-flex justify-content-between my-3">
                        <div class="text-start">
                            <a class="btn btn-info text-white me-2 <?php if ($type == 1) echo "active" ?>" href="admin-classify.php?classifyP=<?= $classifyP ?>&type=1">遞增</a>
                            <a class="btn btn-info text-white mx-2 <?php if ($type == 2) echo "active" ?>" href="admin-classify.php?classifyP=<?= $classifyP ?>&type=2">遞減</a>
                            <a class="btn btn-info text-white mx-2" href="admin-classify-doCreate.php">新增總分類</a>
                        </div>
                        <div class="py-2 d-flex d-inline text-end">
                            共 <?= $total ?> 筆
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>刪除</th>
                            <th>編輯</th>
                            <th>總分類ID</th>
                            <th>總分類名稱</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($classify_count > 0) : ?>
                            <?php
                            foreach ($rows as $row) :
                            ?>
                                <tr class="align-middle text-center">
                                    <td><a class="text-decoration-none" style="color: #212529;" href='admin-classify-doDelete-program.php?id=<?= $row["id"] ?>'><i class="fa-solid fa-calendar-xmark"></i> 刪除</a></td>
                                    <td><a class="text-decoration-none" style="color: #212529;" href='admin-classify-edit.php?id=<?= $row["id"] ?>&classifyP=<?= $classifyP ?>'><i class="fa-solid fa-pen-to-square"></i> 編輯</a></td>
                                    <td><?= $row["id"] ?></td>
                                    <td><?= $row["classify_name"] ?></td>
                                    <td><a class="btn btn-info text-white align-middle" href="../Category/admin-category.php?type=1&classify_id=<?= $row["id"] ?>">詳細</a></td>
                                </tr>
                            <?php endforeach; ?>
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
                                <?php if ($classifyP > 1) : ?>
                                    <li class="page-item">                                        
                                        <a class="page-link" href="admin-classify.php?classifyP=<?= $classifyP - 1 ?>&type=<?= $type ?>"><</a>
                                    </li>
                                <?php endif; ?>
                                    <!--此段為當前頁按鈕 -->
                                    <li class="page-item"><button class="page-link" href=""><?= $classifyP ?></button></li>

                                    <!--此段為檢測是否顯示下一頁按鈕 -->
                                    <?php if ($classifyP < $page_count) : ?>
                                        <li class="page-item"><a class="page-link" href="admin-classify.php?classifyP=<?= $classifyP + 1 ?>&type=<?= $type ?>">></a></li>
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