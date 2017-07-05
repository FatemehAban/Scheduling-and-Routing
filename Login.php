
<?php
    $servername = "148.72.232.169";
    $username = "ant";
    $password = "AntColony";
    $dbname = "ant";
    $dbport = "3306";

    $con = mysqli_connect($servername,$username,$password,$dbname,$dbport);
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $statement = mysqli_prepare($con, "SELECT * FROM user WHERE username = ? AND password = ?");
    mysqli_stmt_bind_param($statement, "ss", $username, $password);
    mysqli_stmt_execute($statement);
    
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID, $name, $age, $gender, $username, $password, $Longitude, $Latitude, $timeStamp);
    
    $response = array();
    $response["success"] = false;  
    
    while(mysqli_stmt_fetch($statement)){
        $response["success"] = true;  
        $response["name"] = $name;
        $response["age"] = $age;
        $response["gender"] = $gender;
        $response["username"] = $username;
        $response["password"] = $password;
       
    }
    
    echo json_encode($response);
?>

