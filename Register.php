<?php

    $servername = "148.72.232.169";
    $username = "ant";
    $password = "AntColony";
    $dbname = "ant";
    $dbport = "3306";

    $connect = mysqli_connect($servername,$username,$password,$dbname,$dbport);
  
    
    $name = $_POST["name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $response = array();
    $response["name"] = $name; 
    $response["age"] = $age; 
    $response["gender"] = $gender; 
    $response["username"] = $username; 
    $response["password"] = $password;
    $response["success"] = false;

    
    function registerUser() {
        global $connect, $name, $age, $gender, $username, $password, $response;
        $statement = mysqli_prepare($connect, "INSERT INTO user (name, age, gender, username, password) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($statement, "sisss", $name, $age, $gender, $username, $password);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        $response["success"] = true;     
    }
    
    function usernameAvailable() {
        global $connect, $username;
        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ?"); 
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 
        if ($count < 1){
            return true; 
        }else {
            return false; 
        }
    }

         
    if (usernameAvailable()){        
        registerUser(); 
    }
    
    echo json_encode($response);
?>