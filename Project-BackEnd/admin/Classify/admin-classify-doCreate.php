<?php
require_once("../project-connect.php");

// 所有使用者
$sql = "SELECT * FROM classify WHERE id=1";
$result = $conn->query($sql);
$classify_count = $result->num_rows;
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
        .table-wrap {
            height: 540px;
        }
        .container .btn{
            background: #CA965C;
            border: #CA965C;
        }
    </style>
</head>

<body>
    <?php require_once("../layout/ad-header.php"); ?>
    <div class="d-flex">
        <?php require_once("../layout/ad-classify-sidebar.php"); ?>
        <?php if ($classify_count > 0) : ?>
            <?php foreach ($rows as $row) : ?>
                <div class="container" style="height: 540px;">
                    <div class="table-warp">
                        <div class="justify-content-center" style="width:80%">
                            <form action="admin-classify-doCreate-program.php" method="post" class="d-block-flex">
                                <!-- 因為用POST傳送表單到下一層admin-category-doCreate-program.php , 所以在第39行要加上<input type="hidden"...> 讓它可以把classify_id值可以傳過去，然後接到值 -->
                                <div class="d-flex mt-5 justify-content-end">
                                    <div class="col-auto text-end my-auto">
                                        <label class="me-5" for="name">總分類名稱</label>
                                    </div>
                                    <div style="width:60%">
                                        <input type="hidden" value="<?= $classify_id ?>" name="classify_id">
                                        <input type="text" id="classify_name" class="form-control" name="classify_name" required>
                                    </div>
                                </div>
                                <div class="py-2 text-end mt-4">
                                    <button type="button" class="btn btn-info text-white me-3">
                                        <a class="text-decoration-none text-white" href="admin-classify.php?id=<?= $row["id"] ?>">取消新增</a></button>
                                    <button type="submit" class="btn btn-info text-white px-4">儲存</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <?= "no data." ?>
        <?php endif; ?>
    </div>



    <script src="sidebars.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>