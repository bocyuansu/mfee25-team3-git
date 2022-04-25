<?php
    require_once("../project-connect.php");

    $id=$_POST["id"];
    $classify_name=$_POST["classify_name"];
    $classifyP = $_POST["classifyP"];
    
    $sql="UPDATE classify SET classify_name='$classify_name' WHERE id='$id'";

    // echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "更新成功";
        $conn->close();
        header("location: admin-classify.php?id=".$id."&classifyP=".$classifyP);
    } else {
        echo "更新資料錯誤: " . $conn->error;
        exit;
    }
?>