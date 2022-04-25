<?php
    require_once("../project-connect.php");

    if(!isset($_POST["classify_name"]))
    {
        echo "您不是透過正常管道到此頁";
        exit;
    }

    $classify_name=$_POST["classify_name"];
    if(empty($classify_name))
    {
        echo "您有欄位沒有填寫";
        return;
    }
   
    $sql_classify="INSERT INTO classify (classify_name)
    VALUES ('$classify_name')";
    
    if ($conn->query($sql_classify) === TRUE) 
        {
            echo "新增資料完成<br>"; 
            $last_id=$conn->insert_id; // 最新資料取得
            // echo "last id is $last_id";
            // exit;
        } 
            else 
            {
            echo "新增資料錯誤: " . $conn->error;
            exit; // 錯誤的話會停在這
            }
        
        $conn->close();

        header("location: admin-classify.php");
?>