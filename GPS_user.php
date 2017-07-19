<?php

// compute distance between two geo point and translate into Kilo Meters.
function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2) {
    $theta = $longitude1 - $longitude2;
    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $kilometers = $miles * 1.609344;

    return $kilometers; 
}
    $connect = mysqli_connect("localhost","id1771399_fatemeh4057","fatemeh4057","id1771399_mysystem");

    
    $response = array();
    

    //$longitude = 101.65983237545355;
    //$latitude = 3.123892922198446;

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

    // This section is add Longi and Lati of driver.

    
   $driverinfo = array();
   $mysqli_connect = "SELECT Username, longitude, latitude FROM Driver";
   $result = $connect->query($mysqli_connect);

   if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {      

        array_push($driverinfo, array ("longitude" => $row["longitude"], "latitude" => $row["latitude"], "username" => $row["Username"]));
    }

    //echo '<pre>';
    //print_r($driverinfo);
    //echo '</pre>';
    

    //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ 
    $nearby_drivers = array();

    for ($x = 0; $x < sizeof($driverinfo); $x++) {
        $distance =  getDistanceBetweenPointsNew ($driverinfo[$x] ["latitude"],$driverinfo[$x] ["longitude"], $latitude,  $longitude)."<br>";
        if ($distance < 5.0){
            array_push($nearby_drivers, $driverinfo[$x]);
        }    
    }
    // incase no driver found in 5 KM search in 10 KM
    if(sizeof($nearby_drivers) < 1){
         for ($x = 0; $x < sizeof($driverinfo); $x++) {
            $distance =  getDistanceBetweenPointsNew ($driverinfo[$x] ["latitude"],$driverinfo[$x] ["longitude"], $latitude,  $longitude)."<br>";
            if ($distance < 10.0){
                array_push($nearby_drivers, $driverinfo[$x]);
            }    
        }
    }



    //echo "<br><br> near By Driver List <br><br>";
    //echo '<pre>';
    //print_r($nearby_drivers);
    //echo '</pre>';


}

$connect->close();


?>
