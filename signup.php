<?php
    require 'connection.php';
 
  
   
    if(isset($_POST['submit'])){
    // Fetching variables of the form which travels in URL
        $mobile_number = $_POST['mobilenumber'];
        $email = $_POST['email'];
        $password = $_POST["password"];
       
        $error = '';
       
            if(!preg_match('/^[0-9]{10}+$/', $_POST['mobilenumber']))
            {
                $error = 'The Mobile Number is Invalid! Please Enter your 10 Digit Mobile Number';
                echo "<script>alert('$error')</script>";
                $errorStatus = 1;
            
            }
       
           else{
               try{
                $query = ("insert into signup(mobile_number,email,password) values ('$mobile_number','$email','$password')");
                $db->query($query);
                echo "Thank You for Registering!! You can reach us by Signing In Again";
                echo "<br><a href='signin-signup.html'> Click here to Sign</a>";
               }catch(Exception $e){

               echo "Entered Details seems to be exist Already!! Kindly Login";
               echo "<br><a href='signin-signup.html'> Click here to Login</a>";
           }
           } 
        
     
    }
    
?>
        
        

<script type="text/javascript">
    var errorStatus = <?php echo $errorStatus ?>;
    if(errorStatus == 1){
        document.write("Kindly try it again");
        
    
    }
    else{
    document.write("Your Data Have been Registered Successfully!!");
    document.write("Click the Sign In Button to go to Sign In page");
    }
    
    
    
    </script>