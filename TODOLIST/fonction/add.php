<?php

if(isset($_POST['title'])){
    require '../db_connect.php';

    $title = $_POST['title'];

    if(empty($title)){
        header("location: ../index.php?mess=error");
    }else {
        $stmt = $connect->prepare("INSERT INTO todos(title) VALUE(?)");
        $res = $stmt->execute([$title]);

        if($res){
            header("location: ../index.php?mess=succes");
        }else{
            header("location: ../index.php");
        }
        $connect =null;
        exit();
    }
}else {
    header("location: ../index.php?mess=error");
}

?>