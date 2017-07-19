
<?php
    $connect = mysqli_connect("localhost","id1771399_fatemeh4057","fatemeh4057","id1771399_mysystem");

    function distance($lat1, $lon1, $lat2, $lon2, $unit) {

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

    // This section is add Longi and Lati of driver 

    
   $driverinfo = array();
   $mysqli_connect = "SELECT Username, longitude, latitude FROM Driver";
   $result = $connect->query($mysqli_connect);

   if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       

        array_push($driverinfo, array ("longitude" => $row["longitude"], "latitude" => $row["latitude"], "username" => $row["Username"]));
    }

    echo '<pre>';
    print_r($driverinfo);
    echo '</pre>';
    
}

$connect->close();



  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);}
}

//echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";


?>
