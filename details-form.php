<?php
    require 'connection.php';
 
    if(isset($_POST['submit'])){ // Fetching variables of the form which travels in URL
        $name = $_POST['name'];
        $contactNumber = $_POST['contactNumber'];
       
        if($name !=''||$contactNumber !=''){
        //Insert Query of SQL
        $query = ("insert into user_search(name,contactNumber) values ('$name','$contactNumber')");
        $db->query($query);
        
        }
        
        }
?>
<script type="text/javascript">
    document.write("Your Data Have been recorded Successfully!!");
    setTimeout("window.close();", 1000);
    
    </script>