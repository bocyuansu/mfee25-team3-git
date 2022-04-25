<?php
if (!isset($_GET["id"])) {
    header("location: 404.php");
}


$id = $_GET["id"];

//isset用于检测变量是否已设置并且非NULL

require_once("db-connect.php");

// $sql = "SELECT product.*, category.category_name FROM product 
// JOIN category ON product.category_id = category.id
// WHERE product.valid=1";

$sql = "SELECT * FROM product WHERE id='$id' AND valid=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if (!$row) {
    header("location: 404.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>商品內容</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
 

        .img_container {
            max-height: 300px;
            max-width: 300px;
            /* border-radius: 10px; */
            overflow: hidden;
            display: flex;
        }

        .img_container img {
            object-fit: cover;
            width: 100%;
        }
    </style>

</head>

<body>

    <!-- <?php var_dump($row); ?> -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="update_product.php" method="post">
                    <!-- <div class="py-2">
                    <a class="btn btn-info text-white"href="user-list.php">回列表</a>
                </div> -->
                    <table class="table table-bordered mt-5 " style="width:600px">
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">

                        <tr >
                            <th style="width:150px">商品編號</th>
                            <td><?= $row["product_num"] ?></td>
                        </tr>
                        <tr>
                            <th style="width:150px">商品名稱</th>
                            <td><input class="form-control" type="text" name="product_name" value="<?= $row["product_name"] ?>" style="width:400px"></td>
                        </tr>
                        <tr>
                            <th style="width:150px" >類別</th>
                            <td><input class="form-control" type="text" name="category" value="<?= $row["category"] ?>" style="width:400px"></td>
                        </tr>
                        <tr>
                            <th style="width:150px">金額</th>
                            <td><input class="form-control" type="num" name="price" value="<?= $row["price"] ?>" style="width:400px"></td>
                        </tr>
                        <tr>
                            <th style="width:150px">庫存數量</th>
                            <td><input class="form-control" type="num" name="product_count" value="<?= $row["product_count"] ?>" style="width:400px"></td>
                        </tr>
                   
                        <tr >
                            <th style="width:150px">商品圖片</th>
                            <td><input type="file" class="form-control" id="img" name="img" accept=".jpg, .jpeg, .png, .webp, .svg" style="width:400px"></td>
                        </tr>
               
                        <tr class="border-end">
                            <th></th>
                            <td class=" img_container ">
                                <img id="prd_img_show" src="images/<?= $row["img"]?>" />
                            </td>
                        </tr>



                    </table>
                    <div class="py-2">
                        <button type="submit" class="btn btn-info text-white">儲存</button>
                        <a class="btn btn-info text-white" href="product_list.php?id=<?= $row["id"] ?>">取消</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $("#img").change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".img_container").css('display', "flex");
                    $("#prd_img_show").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>