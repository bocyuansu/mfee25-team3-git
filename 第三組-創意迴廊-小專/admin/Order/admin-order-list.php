<?php
require_once("../project-connect.php");

/*刪除資料表內容*/
if (isset($_POST['delete_product'])){
	$id = $_POST['delete_id'];
   $sqlOrder = "DELETE FROM user_order WHERE id = '$id'";
	$query_run_order = mysqli_query($conn,$sqlOrder);
   $sqlDetail = "DELETE FROM user_order_detail WHERE order_id = '$id'";
   $query_run_detail = mysqli_query($conn,$sqlDetail);
   header("location: admin-order-list.php?");
}

if(isset($_GET["title"])){
   $title = $_GET["title"];
}else{
   $title = "id";
}

$var_WHERE = "";
$var_date1 = "";
$var_date2 = "";

if(empty($_GET["date1"]) || empty($_GET["date2"])){
   $var_WHERE = "";
}else{
   $var_date1 = $_GET["date1"]." 00:00:00";
   $var_date2 = $_GET["date2"]." 23:59:59";
   $var_WHERE = "WHERE order_date BETWEEN '$var_date1' AND '$var_date2'";
}

if(!isset($_GET["p"])){
   $p=1;
}else{
   $p=$_GET["p"];
}

# Admin Order List
$sql = "SELECT * FROM user_order $var_WHERE ORDER BY $title ASC";
$result = $conn->query($sql);
// $rows = $result->fetch_all(MYSQLI_ASSOC);
# 資料筆數
$total = $result->num_rows;

// 每頁顯示筆數
$per_page = 5; 

// CEIL 無條件進位 ； 計算共幾頁
$page_count = CEIL($total/$per_page);

// 透過 $p 控制 LIMIT 即可 控制顯示的資料範圍
$start = ($p -1) * $per_page;

$sql = "SELECT * FROM user_order $var_WHERE ORDER BY $title ASC 
LIMIT $start, $per_page"; 

$result = $conn->query($sql);
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
         .num{
            text-decoration: none;
         }
         .table-wrap{
            height: 505px;
         }
         .my-btn{
            font-size: 16px;
            padding: 6px 12px;
            color: #FFF;
            background-color: #CA965C;
            border: 0;
            border-radius: 0.25rem;
         }
         .my-color{
            color: #4F345A;
         }
         .page-item.active .page-link{
            background: #DFBB8B;
            border: #DFBB8B;
            color: black;
         }
         .page-link{
            color: black;
            border:  #DFBB8B;
         }


   </style>
</head>
<body>
    <?php require_once("../layout/ad-header.php"); ?>
    <div class="d-flex">
        <?php require_once("../layout/ad-order-sidebar.php"); ?>
        <div class="container">
        <div class="py-3">
            <form action="">
               <div class="row">
                  <?php if (isset($_GET["p"])) : ?>
                     <input type="hidden" name="p" value="<?= $p ?>">
                  <?php endif; ?>
                  <?php if (isset($_GET["title"])) : ?>
                     <input type="hidden" name="title" value="<?= $title ?>">
                  <?php endif; ?>
                  <?php if (isset($_GET["date1"])) : ?>
                     <input type="hidden" name="date1" value="<?= $var_date1 ?>">
                  <?php endif; ?>
                  <?php if (isset($_GET["date2"])) : ?>
                     <input type="hidden" name="date2" value="<?= $var_date2 ?>">
                  <?php endif; ?>
                  <h1 class="my-4 my-color">訂單資料</h1>
                  <div class="col-auto d-flex align-items-end">
                     <label for="" class="h5">按照</label>
                  </div>
                  <div class="col-auto">
                     <select name="title" id="" class="form-control">
                        <option value="id" <?php if($title == "id"): echo "selected"?><?php endif ;?>>訂單編號</option>
                        <option value="member_num" <?php if($title == "member_num"): echo "selected"?><?php endif ;?>>會員編號</option>
                     </select>
                  </div>
                  <div class="col-auto">
                     <button type="submit" class="my-btn">排序</button>
                  </div>
               </div>
            </form>
         </div>
         <div class="row justify-content-end">
            <div class="col-auto">
               <form action="">
                  <?php if(isset($_GET["title"])):?>
                     <input type="hidden" name="title" value="<?=$title?>">
                  <?php endif;?>
                  <div class="row">
                     <div class="col-auto">
                        <input type="date" name="date1" class="form-control">
                     </div>
                     <div class="col-auto">
                        <label class="col-form-label" for="">~</label>
                     </div>
                     <div class="col-auto">
                        <input type="date" name="date2" class="form-control">
                     </div>
                     <div class="col-auto">
                        <button type="submit" class="my-btn">查詢</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="py-2 text-end mt-4">
               第 <?=$p?> 頁 , 共 <?=$page_count?> 頁 , 共 <?=$total?> 筆
         </div>
         <div class="table-wrap">
            <table class="table table-bordered text-center align-middle">
                <thead>
                   <tr>
                      <th>訂單編號</th>
                      <th>訂單日期</th>
                      <th>會員編號</th>
                      <th>會員名稱</th>
                      <th>總金額</th>
                      <th>寄送地址</th>
                      <th></th>
                   </tr>
                </thead>
                <tbody>
                   <?php foreach($rows as $row): ?>
                      <tr>
                         <td><a href="admin-order-detail.php?listp=<?=$p?>&title=<?=$title?>&id=<?=$row["id"]?>" class="num"><?=$row["id"]?></a></td>
                         <td><?=$row["order_date"]?></td>
                         <td><?=$row["member_num"]?></td>
                         <td><?=$row["member_name"]?></td>
                         <td>$
                         <?php
                              $Moneytotal = 0;
                              $Moneyid = $row["id"];

                              $sqlMoney = "SELECT * FROM user_order_detail WHERE user_order_detail.order_id = $Moneyid";
                              $resultMoney = $conn->query($sqlMoney);
                              $rowsMoney = $resultMoney->fetch_all(MYSQLI_ASSOC);
    
                              foreach ($rowsMoney as $rowMoney) {
                                    $subtotal = $rowMoney["price"] * $rowMoney["amount"];
                                    $Moneytotal += $subtotal;
                              }
                              echo $Moneytotal;
                           ?>
                         </td>
                         <td><?=$row["order_address"]?></td>
                         <td>
                            <form  method="post" action="">
                               <input type="hidden" name="delete_id" value="<?=$row["id"]?>">
                               <button name="delete_product" class="my-btn" onclick="javascript:return del();">刪除</button>
                            </form>
                         </td>
                      </tr>
                   <?php endforeach; ?>
                </tbody>
            </table>
         </div>
         <div class="row">
            <div class="col">
               <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
                     <?php if($p > 1):?>
                        <li class="page-item"><a class="page-link" href="admin-order-list.php?title=<?=$title?>&p=<?=$p-1?>&date1=<?=$var_date1?>&date2=<?=$var_date2?>"><</a></li>
                     <?php endif; ?>

                     <li class="page-item active"><a class="page-link" href="admin-order-list.php?title=<?=$title?>&p=<?=$p?>&date1=<?=$var_date1?>&date2=<?=$var_date2?>"><?=$p?></a></li>

                     <?php if($p < $page_count):?>
                        <li class="page-item"><a class="page-link" href="admin-order-list.php?title=<?=$title?>&p=<?=$p+1?>&date1=<?=$var_date1?>&date2=<?=$var_date2?>">></a></li>
                     <?php endif; ?>
                  </ul>
               </nav>
            </div>
         </div>

        </div>
    </div>



    <script src="../sidebars.js"></script>
    <script>
        function del(){
            var msg = "您確定要刪除嗎？\n請確認！";
            if (confirm(msg)==true){
                return true;
            }else{
                return false;
            }
        };
    </script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>