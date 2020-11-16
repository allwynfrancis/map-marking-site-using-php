<?php
$servername = "localhost:3300";
$username = "root";
$password = "root";


  $conn = "mysql:host=$servername;dbname=LocationDb";
  try {
    
    $db = new PDO($conn, $username, $password);
    
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    // $sth = $db->query("SELECT name,address,lat,lng,contact,sunday,monday,tuesday,wednesday,thrusday,friday,saturday,city FROM locations");
    // $locations = $sth->fetchAll();
    
    // echo json_encode( $locations );
    // echo "Connected Successfully";
    } catch (Exception $e) {
    echo $e->getMessage();
    }

?>
