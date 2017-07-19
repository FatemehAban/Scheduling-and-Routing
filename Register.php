<?php

    
    $statement = null;

    $connect = mysqli_connect("localhost","id1771399_fatemeh4057","fatemeh4057","id1771399_mysystem");

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
    $isDriver = $_POST["isdriver"];

    $response = array();
    $response["name"] = $name; 
    $response["age"] = $age; 
    $response["gender"] = $gender; 
    $response["username"] = $username; 
    $response["password"] = $password;
    $response["isdriver"] = $isDriver; 




    function register() {
        global $connect, $name, $age, $gender, $username, $password, $isDriver, $statement;
        if($isDriver == "false"){
            $statement = mysqli_prepare($connect, "INSERT INTO user (name, age, gender, username, password) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($statement, "sisss", $name, $age, $gender, $username, $password);
        }
        else{
            $statement = mysqli_prepare($connect, "INSERT INTO Driver (name, age, gender, username, password) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($statement, "sisss", $name, $age, $gender, $username, $password);
        }
        
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        $response["success"] = true;     
    }
    
    function usernameAvailable() {
        global $connect, $username, $isDriver, $statement;
        if($isDriver == "false"){
            $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ?");
        } 
        else{
            $statement = mysqli_prepare($connect, "SELECT * FROM Driver WHERE username = ?");
        }
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
   
    $response["success"] = false;  
    if (usernameAvailable()){
        global $response;
        $response["success"] = true;
        register(); 
    }
    
    echo json_encode($response);
?>