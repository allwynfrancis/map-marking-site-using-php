<?php
    require 'connection.php';
    if(isset($_POST['submit'])){
        // Fetching variables of the form which travels in URL
            // $id = $_POST['id'];
            // $name= $_POST['name'];  
            $email = $_POST['email'];
            $password = $_POST["password"];

            $query = ("select * from signup where email='$email' and password='$password'");
            // $query = ("select * from googleregister where id='$id' and name='$name'");
            $result = $db->query($query);
           
            if ($result->rowCount() > 0){
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    // Do stuff
                    echo "Login Successful";
                    echo "<br>To Go to Location Searching Page,";
                   
                    echo "<br><a href='index.html'> Click here</a>";
                }
            }
               
            
            
            else{
                echo "Login failed";
                
                echo "<br>Kindly Sign Up or Kindly Login Again With Valid Credentials";
                echo "<br><a href='signin-signup.html'> Click here to Login</a>";
            }
    }    


    ?>
 