
<?php
    $connect = mysqli_connect("localhost","id1771399_fatemeh4057","fatemeh4057","id1771399_mysystem");

    $response = array();
    
   
    $longitude = $_POST["longitude"];
    $latitude = $_POST["latitude"];
    $username = $_POST["username"];
    $name = $_POST["name"];


    $response["longitude"] = $longitude; 
    $response["latitude"] = $latitude; 
    $response["username"] = $username;
    $response["name"] = $name 
    
    function GPSLocation() {
        global $connect, $longitude, $latitude, $username;
        $statement = mysqli_prepare "UPDATE user SET latitude = ?, longitude= ?  WHERE username= ? ";
        mysqli_stmt_bind_param($statement, "dds", $latitude, $longitude, $username);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);     
    }

    $response["success"] = true;

    echo json_encode($response);

?>