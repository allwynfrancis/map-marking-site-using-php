<?php
        require 'connection.php';

        $id = $_POST['id'];
        $name= $_POST['name'];  
           

      
        $query = ("select * from fbregister where id='$id' and name='$name'");
        $result = $db->query($query);
                  
        if ($result->rowCount() > 0){
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // Do stuff
                echo "Login Successful";
            }
        }
           
        
        
        else{
    
        $query = ("insert into fbregister(id,name) values ('$id','$name')");
        $db->query($query);
        echo "Registration Successful";
        }
?>