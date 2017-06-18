<?php
    $con = mysqli_connect("localhost","id1771399_fatemeh4057","fatemeh4057","id1771399_mysystem");
    if (!empty($POST))
    {

        $name = $_POST["name"];
        $age = $_POST["age"];
        $username = $_POST["username"];
        $gender = $_POST["gender"];
        $password = $_POST["password"];

    $statement = mysqli_prepare($con, "INSERT INTO user (name, username, age, password, gender) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement, "ssiss", $name, $username, $age, $password,$gender);
    mysqli_stmt_execute($statement);
    
    $response = array();
    $response["success"] = true;  
    }
    else
    {
        $response["message"]= "No data found in post message";
        $response["success"] = false;
    }
    
    echo json_encode($response);
?>