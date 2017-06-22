
<?php
    require("password.php");
    $con = mysqli_connect("localhost","id1771399_fatemeh4057","fatemeh4057","id1771399_mysystem");
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $response = array();
    
    $statement = mysqli_prepare($con, "SELECT * FROM user WHERE username = ?");
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $colUserID, $colName, $colAge, $colGender, $colUsername,  $colPassword);  


    $response["success"] = false;


    while(mysqli_stmt_fetch($statement)){
       // if (password_verify($password, $colPassword)) {
            $response["success"] = true;  
            $response["name"] = $colName;
            $response["username"]= $colUsername;
          
       // }
    }
    echo json_encode($response);
?>