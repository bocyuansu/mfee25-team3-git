<?php
require_once("../project-connect.php");

$classify_id = $_GET["classify_id"];
// $classify_name = $_GET["classify_name"];

// 所有使用者
// $sql = "SELECT * FROM category WHERE id=1";
$sql = "SELECT classify.classify_name, category.* FROM classify JOIN category ON classify.id = category.classify_id
  WHERE classify_id =  $classify_id
  AND category.valid=1
  AND category.id=category.id
  LIMIT 0, 1";
$result = $conn->query($sql);
$category_count = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);

// var_dump($classify_id_value);

$sql_classify_id = "SELECT * FROM classify
    WHERE id = $classify_id";  
    $sql_result = $conn->query($sql_classify_id);    
    $classify_id_value = $sql_result->fetch_all(MYSQLI_ASSOC);

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
        .table-wrap {
            height: 540px;
        }

        .container .btn {
            background: #CA965C;
            border: #CA965C;
        }
    </style>
</head>

<body>
    <?php require_once("../layout/ad-header.php"); ?>
    <div class="d-flex">
        <?php require_once("../layout/ad-classify-sidebar.php"); ?>
        <div class="container" style="height: 540px;">
            <div class="table-warp">
                <div class="justify-content-center" style="width:80% ">
                    <form action="admin-category-doCreate-program.php" method="post" class="d-block-flex">
                        <div class="pt-3 d-block">
                            <h1><?= $classify_id_value[0]["classify_name"]  ?></h1>
                        </div>
                        <div class="d-flex mt-4 justify-content-end">
                            <div class="col-auto text-end my-auto">
                                <label class="me-5" for="name">類別名稱</label>
                            </div>
                            <div style="width:60%">
                                <input type="hidden" value="<?= $classify_id ?>" name="classify_id">
                                <!--使用方法2再寫這行，把值以post方式傳到下一層-->
                                <!-- <input type="hidden" value=" //$classify_name " name="classify_name"> -->
                                <input type="text" id="category_name" class="form-control" name="category_name" required>
                            </div>
                        </div>
                        <div class="py-2 text-end mt-4">
                            <button type="button" class="btn btn-info text-white me-3">
                                <a class="text-decoration-none text-white" href="admin-category.php?type=1&classify_id=<?= $classify_id ?>">取消新增</a></button>
                            <button type="submit" class="btn btn-info text-white px-4">儲存</button>
                        </div>
                    </form>
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