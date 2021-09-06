<?php

    $servername="DESKTOP-S8A6TJB";
    $conexion= array("Database"=> "Sist3",
                    "UID"=> "adminapp",
                    "Password"=> "adminapp",
                    "CharacterSet" => "UTF-8");

    $con = sqlsrv_connect($servername, $conexion);
    if($con){
        echo "conexion exitosa";
    }else{
        echo "fallo en la conexion";
    }
?>