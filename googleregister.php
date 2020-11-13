<?php
        require 'connection.php';

        $id = $_POST['id'];
        $name= $_POST['name'];  
        $email= $_POST['email'];     

      
 $query = ("select * from googleregister where id='$id' and name='$name'");
 $result = $db->query($query);
           
 if ($result->rowCount() > 0){
     while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
         // Do stuff
         echo "Login Successful";
        
     }
     
 }
    
 
 
 else{
    
        $query = ("insert into googleregister(id,name,email) values ('$id','$name','$email')");
        $db->query($query);
        echo "Registration Successful";
    
 }
    
   
?>

