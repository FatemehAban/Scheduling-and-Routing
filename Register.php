<?php
    $con = mysqli_connect("localhost","id1771399_fatemeh4057","cXKq37uGRHCGYt0k","id1771399_mysystem");
    
    $name = $_POST["name"];
    $age = $_POST["age"];
    $username = $_POST["username"];
    $gender = $_POST["gender"];
    $password = $_POST["password"];
    $statement = mysqli_prepare($con, "INSERT INTO user (name, username, age, password) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement, "siss", $name, $username, $age, $password);
    mysqli_stmt_execute($statement);
    
    $response = array();
    $response["success"] = true;  
    
    echo json_encode($response);
?>