<?php
    require_once("../project-connect.php");

    $id=$_POST["id"];
    $category_name=$_POST["category_name"];
    $classify_id=$_POST["classify_id"];
    // 使用方法2再寫這行，將上一層值接過來
    // $classify_name=$_POST["classify_name"];
    // 因為在上一層admin-category-edit.php用POST將classify_id值傳過來，所以要再用一個POST接，並在第18-19行將classify_id值寫入
    // location的最後面都加上 &classify_name=<?= $row["classify_name"] 來抓值
    
    $sql="UPDATE category SET category_name='$category_name' WHERE id='$id'";

    // echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "更新成功";
        $conn->close();
        header("location: admin-category.php?id=".$id."&classify_id=".$classify_id);
    } else {
        echo "更新資料錯誤: " . $conn->error;
        exit;
    }
?>