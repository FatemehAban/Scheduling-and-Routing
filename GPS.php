<?php
    $servername = "148.72.232.169";
    $username = "ant";
    $password = "AntColony";
    $dbname = "ant";
    $dbport = "3306";

    $connect = mysqli_connect($servername,$username,$password,$dbname,$dbport);

    $response = array();    
   
    $longitude = $_POST["longitude"];
    $latitude = $_POST["latitude"];
    $username = $_POST["username"];
    $name = $_POST["name"];


    $response["longitude"] = $longitude; 
    $response["latitude"] = $latitude; 
    $response["username"] = $username;
    $response["name"] = $name; 
    
    $statement = mysqli_prepare($connect, "UPDATE user SET latitude = ?, longitude= ?  WHERE username= ? ");
    mysqli_stmt_bind_param($statement, "dds", $latitude, $longitude, $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);     


    $response["success"] = true;

    echo json_encode($response);

?>