<?php
require_once("../project-connect.php");

if(!isset($_SESSION["user"])){
    header("location: ../Login/back-end-login.php");
    exit;
}

$sql = "SELECT * FROM product ORDER BY id DESC";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

?>


<!doctype html>
<html lang="en">

<head>
    <title>CreateProduct</title>
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
            border-radius: 10px;
            overflow: hidden;
            display: none;


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
    </style>


</head>

<body>

<?php require_once("../layout/be-header.php"); ?>
   <div class="d-flex">
      <?php require_once("../layout/be-product-sidebar.php"); ?>
      <div class="container">

          <div class="div">
              <h1 class="text-center mt-3">新增商品</h1>
          </div>
          <div class="container py-3">
              <form action="doUpload.php" method="post">
                  <div class="row mt-3">
                      <div class="col-lg-6">
                          <div class="mb-2 d-none">
                              <label for="">商品編號
                              </label>
                              <input type="text" class="form-control" id="product_num" name="product_num" style="width:400px">
                          </div>
                          <div class="mb-2 d-none">
                              <label for="">廠商名字
                              </label>
                              <input type="text" class="form-control" id="vendor_id" name="vendor_id" style="width:400px" value="<?= $_GET["vendor_id"] ?>">
                          </div>
                          <div class="mb-2">
                              <label for="">商品名稱
                              </label>
                              <input type="text" required="required" class="form-control" id="product_name" name="product_name" style="width:400px">
                          </div>
                          <div class="mb-2">
                              <label for="">商品金額
                              </label>
                              <input type="number" required="required" class="form-control" name="price" id="price" min="0" style="width:400px">
                          </div>
                          <div class="mb-2">
                              <label for="">庫存數量
                              </label>
                              <input type="number" required="required" class="form-control" name="product_count" id="product_count" min="0" style="width:400px">
                          </div>
                          <div class="mb-2 d-none">
                              <label for="">上下架
                              </label>
                              <input type="text" class="form-control" id="shelf" name="shelf" style="width:400px">
                          </div>
      
                          <div class="mb-2">
                              <label for="img">商品圖片
                              </label>
                              <input type="file" class="form-control" id="img" name="img" accept=".jpg, .jpeg, .png, .webp, .svg" style="width:400px">
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class=" img_container my-2">
                              <img id="prd_img_show" src="#" />
                          </div>
                      </div>
                  </div>
      
      
                  <div class="container">
                      <div class="row d-flex ">
                          <div class="col-10 mt-3 p-0">
                              <p>商品分類</p>
                          </div>
                          <div class="col-10 mt-3 p-0">
                              <div class="form-group">
                                  <label for="classify_id">類別</label>
                                  <select id="classify_id" name="classify_id" class="form-control">
                                      <option value="">請選擇</option>
                                      <?php
                                      $sql_classify = "SELECT * FROM classify";
                                      $result_classify = $conn->query($sql_classify);
                                      $rows_classify = $result_classify->fetch_all(MYSQLI_ASSOC);
                                      foreach ($rows_classify as $row_classify) :
                                      ?>
                                          <option value="<?= $row_classify['id'] ?>"><?= $row_classify['classify_name'] ?></option>
                                      <?php endforeach; ?>
      
                                  </select>
                              </div>
                          </div>
                          <div class="col-10 mt-3 p-0 mb-3">
                              <div class="form-group">
                                  <label for="category_id">種類</label>
                                  <select id="category_id" name="category_id" class="form-control">
                                      <option value="">請先選擇種類</option>
                                  </select>
                                  <!-- <div class="d-none">
                                  <select id="category" name="category" class="form-control">
                                      <option value=""></option>
                                  </select>
                                  </div> -->
                              </div>
                          </div>
                      </div>
                  </div>
                  <button class="btn btn-info" type="submit">送出</button>
                  <a class="btn btn-info" href="product_vendor_list.php?vendor_id=<?=$_GET["vendor_id"]?>" type="submit">返回</a>
              </form>
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
              <script>
                  var main = document.getElementById('classify_id');
                  var sub = document.getElementById('category_id');
      
                  // 即時更新
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
                  // main.addEventListener('change', function() {
      
                  //     console.log(category[this.value]);
                  //     return;
                  //     var selected_option = category[this.value];
                  //     selected_option.forEach(function(el){
                  //         let option = new Option(el, el);
                  //         sub.appendChild(option);
                  //     });
                  //     Array.from(selected_option).forEach(function(el) {
                  //         let option = new Option(el, el);
                  //         sub.appendChild(option);
                  //     });
      
                  // });
      
                  // 圖片預覽
              </script>
  
      </div>
   </div>


<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="../sidebars.js"></script>

</body>

</html>