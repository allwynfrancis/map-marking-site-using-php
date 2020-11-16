<?php
    require 'connection.php';
    
    
  
   
    // Fetching variables of the form which travels in URL
        $name = $_POST['name'];
        $contactNumber = $_POST['contactNumber'];
        $city_id = $_POST['city_id'];
        // $city_id1 = '5';
        if($name !='' && $contactNumber !='' && $city_id != ''){
            //Insert Query of SQL
            $query = ("insert into user_search(name,mobile_number,city_id) values ('$name','$contactNumber','$city_id')");
            $db->query($query);
        
        }
        
        
        echo "Recorded";
        // echo gettype($city_id1);
?>
