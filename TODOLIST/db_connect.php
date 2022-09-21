<?php

    $sName = "localhost";
    $uName = "root";
    $password = "";
    $db_name = "todolist";


    try {

        $connect = new PDO("mysql:host=$sName;dbname=$db_name",
                            $uName, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }catch(PDOExpection $e){
        echo "Erreur de connection : ". $e->getMessage();
    }

?>