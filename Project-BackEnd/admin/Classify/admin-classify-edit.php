<?php
if (!isset($_GET["id"])) {
    header("location: admin-classify-404.php");
}

$id = $_GET["id"];
$classifyP = $_GET["classifyP"];


require_once("../project-connect.php");
$sql = "SELECT * FROM classify WHERE id='$id'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
if (!$row) {
    header("location: admin-classify-404.php");
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
        <div class="container">
            <div class="table-warp">
                <div class="row justify-content-center">
                    <div class="col-lg-5 mt-5">
                        <form action="admin-classifyUpdate.php" method="post">
                            <table class="table table-bordered">
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                <input type="hidden" name="classifyP" value="<?= $classifyP ?>">
                                <tr>
                                    <th>總分類ID</th>
                                    <td><?= $row["id"] ?></td>
                                </tr>
                                <tr>
                                    <th>總分類名稱</th>
                                    <td>
                                        <input class="form-control" name="classify_name" type="text" value="<?= $row["classify_name"] ?>">
                                    </td>
                                </tr>
                            </table>
                            <div class="py-2 text-end">
                                <a class="btn btn-info text-white me-3" href="admin-classify.php?id=<?= $row["id"] ?>&classifyP=<?= $classifyP ?>">取消編輯</a>
                                <button type="submit" class="btn btn-info text-white px-4">儲存</button>
                            </div>
                        </form>
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