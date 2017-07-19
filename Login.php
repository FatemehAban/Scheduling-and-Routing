
<?php
   
    $statement =null;
    $ID=null; 
    $name=null;
    $age=null;
    $gender=null; 
    $username=null; 
    $password=null; 
    $longitude=null; 
    $latitude=null; 
    $time=null; 
    $rating=null; 
    $waiting=null; 
    $distance=null;


    $con = mysqli_connect("localhost","id1771399_fatemeh4057","fatemeh4057","id1771399_mysystem");

    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $isdriver = $_POST["isDriver"];
    


    if($isdriver == "false")
    {
    
        $statement = mysqli_prepare($con, "SELECT * FROM user WHERE username = ? AND password = ?");
        mysqli_stmt_bind_param($statement, "ss", $username, $password);
        mysqli_stmt_execute($statement);
    
        mysqli_stmt_store_result($statement);
        mysqli_stmt_bind_result($statement, $ID, $name, $age, $gender, $username, $password, $longitude, $latitude, $time);
    }
    else
    {
        $statement = mysqli_prepare($con, "SELECT * FROM Driver WHERE username = ? AND password = ?");
        mysqli_stmt_bind_param($statement, "ss", $username, $password);
        mysqli_stmt_execute($statement);
    


        mysqli_stmt_store_result($statement);
        mysqli_stmt_bind_result($statement, $ID, $name, $age, $gender, $username, $password, $longitude, $latitude, $time, $rating, $waiting, $distance);

    }
    
    $response = array();
    $response["success"] = false;  
    
    while(mysqli_stmt_fetch($statement)){
        $response["success"] = true;  
        $response["name"] = $name;
        $response["age"] = $age;
        $response["gender"] = $gender;
        $response["username"] = $username;
        $response["password"] = $password;
        $response["isDriver"] = $isdriver;       
    }
    
    echo json_encode($response);
?>

