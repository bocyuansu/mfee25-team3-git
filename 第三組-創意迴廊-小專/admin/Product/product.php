<?php
if (!isset($_GET["id"])) {
    header("location: 404.php");
}


$id = $_GET["id"];

//isset用于检测变量是否已设置并且非NULL

require_once("db-connect.php");
$sql = "SELECT product.*, classify.classify_name, category.category_name FROM product 
JOIN classify ON product.classify_id = classify.id 
JOIN category ON product.category_id = category.id
WHERE product.id='$id' AND product.valid=1";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
if (!$row) {
    header("location: 404.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <style>
        .img{
            width: 300px;
            height: 300px;
        }
        .object-cover{
        width: 100%;
        height: 100%;
        object-fit:contain;
    }

    </style>
</head>

<body>
    <!-- <?php var_dump($row); ?> -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="py-2">
                    <a class="btn btn-info text-white" href="product_list.php">回列表</a>
                </div>
                <table class="table table-bordered "style="width:600px">
                    <tr>
                        <th style="width:100px">商品編號</th>
                        <td ><?= $row["product_num"] ?></td>
                    </tr>
                    <tr>
                        <th style="width:100px">商品名稱</th>
                        <td><?= $row["product_name"] ?></td>
                    </tr>
                    <tr>
                        <th style="width:100px" >類別</th>
                        <td><?= $row["classify_name"] ?> > <?=$row["category_name"]?></td>
                    </tr>
                    <tr>
                        <th style="width:100px" >金額</th>
                        <td><?= $row["price"] ?></td>
                    </tr>
                    <tr>
                        <th style="width:100px">庫存數量</th>
                        <td><?= $row["product_count"] ?></td>
                    </tr>
                   
                    <tr>
                        <th style="width:100px">商品圖片</th>
                        <td class="img"><img class="object-cover" src="images/<?=$row["img"]?>" alt="">

                    </tr>

                </table>
                <div class="py-2">
                    <a class="btn btn-info text-white" href="product_edit.php?id=<?= $row["id"] ?>">編輯</a>
                    <a class="btn btn-danger" href="product_delete.php?id=<?= $row["id"] ?>">刪除</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>