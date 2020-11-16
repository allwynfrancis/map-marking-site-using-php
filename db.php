<?php
require 'connection.php';

$sth = $db->query("SELECT id,name,address,lat,lng,contact,sunday,monday,tuesday,wednesday,thrusday,friday,saturday,city FROM locations");
    $locations = $sth->fetchAll();
    
    echo json_encode( $locations );

  

?>

