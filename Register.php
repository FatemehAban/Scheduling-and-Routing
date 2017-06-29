
<?php
    $connect = mysqli_connect("localhost","id1771399_fatemeh4057","fatemeh4057","id1771399_mysystem");

    $response = array();
    
    $name = $_POST["name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $username = $_POST["username"];
    $password = $_POST["password"];


    $response["name"] = $name; 
    $response["age"] = $age; 
    $response["gender"] = $gender; 
    $response["username"] = $username; 
    $response["password"] = $password; 




    function registerUser() {
        global $connect, $name, $age, $gender, $username, $password;
        $statement = mysqli_prepare($connect, "INSERT INTO user (name, age, gender, username, password) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($statement, "sisss", $name, $age, $gender, $username, $password);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);     
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
    
    $response["success"] = false;  
    if (usernameAvailable()){
        global $response;
        $response["success"] = true;
        registerUser(); 
    }
    
    echo json_encode($response);
?>