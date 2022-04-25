<?php
    require_once("../project-connect.php");
    $classify_id = $_GET["classify_id"];
    // 使用方法2再寫這行，將上一層值接過來
    // $classify_name = $_POST["classify_name"];
    // 因為在上一層admin-category-doCreate.php用POST將classify_id值傳過來，所以要再用一個POST接，並在第18-19行將classify_id值寫入
    // location的最後面都加上 &classify_name=<?= $row["classify_name"] 來抓值

    if(!isset($_GET["id"]))
    {
        header("location: admin-category-404.php");
    }

    $id=$_GET["id"];
    // echo $id;

    require_once("../project-connect.php");

    //SOFT DELETE
    $sql_category="UPDATE category SET valid=0 WHERE id='$id'";
    
    // echo $sql;
    if ($conn->query($sql_category) === TRUE)
        {
            echo "刪除成功"; 
        } 
            else 
            {
            echo "刪除資料錯誤: " . $conn->error;
            } 

    $conn->close();
    header("location: admin-category.php?type=1&classify_id=" . $classify_id);
    // header("location: /project/team-project/admin-category.php?type=1&classify_id=" . $classify_id);
    // echo "<script> location.href = document.referrer; </script>"
?>
