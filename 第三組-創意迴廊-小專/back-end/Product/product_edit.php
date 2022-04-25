<?php


$id = $_GET["id"];

//isset用于检测变量是否已设置并且非NULL

require_once("../project-connect.php");

// $sql = "SELECT product.*, category.category_name FROM product 
// JOIN category ON product.category_id = category.id
// WHERE product.valid=1";

$sql = "SELECT * FROM product WHERE id='$id' AND valid=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// if (!$row) {
//     header("location: 404.php");
// }
// ?>

<!doctype html>
<html lang="en">

<head>
    <title>商品內容</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->

   <link rel="stylesheet" href="../css/be-css.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .img_container {
            max-height: 300px;
            max-width: 300px;
            /* border-radius: 10px; */
            border: none;
            overflow: hidden;
            display: flex;
        }

        .img_container img {
            object-fit: cover;
            width: 100%;

        }

        .btn-info {
        color: #fff;
        background-color: #DFBB8B;
        border-color: #DFBB8B;
        }

        .btn-info:hover{
            background-color: #F4DFBA;
        border-color: #DFBB8B;
        }   

        .btn1{
            background-color: #E3916E;
        }
     

    </style>

</head>

<body>

<?php require_once("../layout/be-header.php"); ?>
   <div class="d-flex">
      <?php require_once("../layout/be-product-sidebar.php"); ?>
      <div class="container">



    <!-- <?php //var_dump($row); 
            ?> -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="update_product.php" method="post">
                    <!-- <div class="py-2">
                    <a class="btn btn-info text-white"href="user-list.php">回列表</a>
                </div> -->
                    <table class="table table-bordered mt-5 " style="width:625px">
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">

                        <tr>
                            <th style="width:150px">商品編號</th>
                            <td><?= $row["product_num"] ?></td>
                        </tr>
                        <tr>
                            <th style="width:150px">商品名稱</th>
                            <td><input class="form-control" required="required" type="text" name="product_name" value="<?= $row["product_name"] ?>" style="width:400px"></td>
                        </tr>
                        <!-- <tr>
                            <th style="width:150px" >類別</th>
                            <td><input class="form-control" type="text" name="category" value="<?= $row["category"] ?>" style="width:400px"></td>
                        </tr> -->

                        <?php //var_dump($row["category_id"]); 
                        ?>

                        <tr>
                            <th style="width:150px">類別</th>
                            <td>
                                <select id="classify_id" name="classify_id" class="form-control" style="width:400px">
                                    <?php
                                    $sql_classify = "SELECT * FROM classify";
                                    $result_classify = $conn->query($sql_classify);
                                    $rows_classify = $result_classify->fetch_all(MYSQLI_ASSOC);
                                    foreach ($rows_classify as $row_classify) :
                                    ?>
                                        <?php
                                        if ($row["classify_id"] == $row_classify['id']) :
                                        ?>
                                            <option value="<?= $row_classify['id'] ?>" selected><?= $row_classify['classify_name'] ?></option>
                                        <?php
                                        else :
                                        ?>
                                            <option value="<?= $row_classify['id'] ?>"><?= $row_classify['classify_name'] ?></option>
                                        <?php
                                        endif;
                                        ?>


                                    <?php endforeach; ?>





                                </select>
                                <select id="category_id" name="category_id" class="form-control mt-2" style="width:400px">
                                    <option value="">請先選擇種類</option>
                                </select>
                            </td>
                        </tr>




                        <tr>
                            <th style="width:150px">金額</th>
                            <td><input class="form-control"required="required" type="num" name="price" value="<?= $row["price"] ?>" style="width:400px"></td>
                        </tr>
                        <tr>
                            <th style="width:150px">庫存數量</th>
                            <td><input class="form-control" required="required" type="num" name="product_count" value="<?= $row["product_count"] ?>" style="width:400px"></td>
                        </tr>
                        <tr>
                            <th style="width:150px">上下架狀態</th>
                            <td> <select id="shelf" name="shelf"required="required"  class="form-control " style="width:400px">
                            
                            <?php if ($row["shelf"] ==1) :?>
                          
                                    <option value="<?=$row["shelf"]=1?>" selected>上架</option>
                                    <option value="<?=$row["shelf"]=0?>">下架</option>
                            <?php else: ?>
                                    <option value="<?=$row["shelf"]=1?>" >上架</option>
                                    <option value="<?=$row["shelf"]=0?>" selected>下架</option>
                            <?php endif; ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th style="width:150px">商品圖片</th>
                            <td><input type="file" class="form-control" id="img" name="img" accept=".jpg, .jpeg, .png, .webp, .svg" style="width:400px"></td>
                        </tr>

                        <tr class="border-end">
                            <th></th>
                            <td class=" img_container ">
                                <img id="prd_img_show" src="../../images/<?= $row["img"] ?>" />
                            </td>
                        </tr>



                    </table>
                    <div class="py-2">
                        <button type="submit" class="btn btn-info text-white">儲存</button>
                        <a class="btn btn1 text-white" href="product_vendor_list.php?vendor_id=<?= $row["vendor_id"] ?>">取消</a>
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
        var main = document.getElementById('classify_id');
        var sub = document.getElementById('category_id');

        <?php $classify_id = $row["classify_id"]; //1
        echo "let classify_id =  $classify_id;";
        $category_id = $row["category_id"];
        echo "let category_id =  $category_id;";
        ?>

        console.log(classify_id);
        $.ajax({
                method: "POST",
                url: "api-createproduct.php",
                dataType: "json",
                data: {
                    id: classify_id
                }
            })

            // 成功
            .done(function(response) {
                // console.log(response);
                // 接收 api 傳遞的值,並且用 status 做判斷
                let status = response.status;
                let content = "";
                switch (status) {
                    // 沒選到一樣清空種類列表
                    case 0: {
                        while (sub.options.length > 0) {
                            sub.options.remove(0);
                        }
                        break;
                    }
                    case 1: {
                        // 先清空前面的列表
                        while (sub.options.length > 0) {
                            sub.options.remove(0);
                        }

                        // 找到列表長度
                        let count = `${response.data.length}`;
                        // console.log(`${response.data.length}`);
                        // console.log(`${response.data[0].id}`);


                        for (let i = 0; i < count; i++) {
                            // 分別把抓到的id 跟 category_name
                            let id = `${response.data[i].id}`;
                            let category_name = `${response.data[i].category_name}`;
                            if (category_id == id) {
                                let option = new Option(category_name, id, true, true);
                                sub.appendChild(option);
                            } else {
                                let option = new Option(category_name, id, false, false);
                                sub.appendChild(option);
                            }


                            // 輸入進去 option 裡的 content 和 value
                            // new Option(content, value);
                        }
                        break;
                    }
                }
                // 失敗 目前還沒遇到問題
            }).fail(function(jqXHR, textStatus) {
                while (sub.options.length > 0) {
                    sub.options.remove(0);
                }
            });

        main.addEventListener('change', function() {
            // 先找到產品的大ID
            // console.log(this.value);
            let id = this.value;
            $.ajax({
                    method: "POST",
                    url: "api-createproduct.php",
                    dataType: "json",
                    data: {
                        id: id
                    }
                })

                // 成功
                .done(function(response) {
                    // console.log(response);
                    // 接收 api 傳遞的值,並且用 status 做判斷
                    let status = response.status;
                    let content = "";
                    switch (status) {
                        // 沒選到一樣清空種類列表
                        case 0: {
                            while (sub.options.length > 0) {
                                sub.options.remove(0);
                            }
                            break;
                        }
                        case 1: {
                            // 先清空前面的列表
                            while (sub.options.length > 0) {
                                sub.options.remove(0);
                            }

                            // 找到列表長度
                            let count = `${response.data.length}`;
                            // console.log(`${response.data.length}`);
                            // console.log(`${response.data[0].id}`);


                            for (let i = 0; i < count; i++) {
                                // 分別把抓到的id 跟 category_name
                                let id = `${response.data[i].id}`;
                                let category_name = `${response.data[i].category_name}`;
                                // console.log(`${response.data[i].id}`);
                                // console.log(`${response.data[i].category_name}`);

                                // 輸入進去 option 裡的 content 和 value
                                // new Option(content, value);
                                let option = new Option(category_name, id);
                                sub.appendChild(option);
                            }
                            break;
                        }
                    }
                    // 失敗 目前還沒遇到問題
                }).fail(function(jqXHR, textStatus) {
                    while (sub.options.length > 0) {
                        sub.options.remove(0);
                    }
                });

        })
    </script>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <script src="../sidebars.js"></script>

</body>

</html>