<?php
    require_once("../project-connect.php");

    if(!isset($_GET["id"]))
    {
        header("location: admin-classify-404.php");
    }

    $id=$_GET["id"];
    // echo $id;

    require_once("../project-connect.php");

    //SOFT DELETE
    $sql_classify="UPDATE classify SET valid=0 WHERE id='$id'";
    
    // echo $sql;
    if ($conn->query($sql_classify) === TRUE)
        {
            echo "刪除成功"; 
        } 
            else 
            {
            echo "刪除資料錯誤: " . $conn->error;
            } 

    $conn->close();
    header("location: admin-classify.php");
?>