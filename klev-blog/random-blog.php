<?php 

    require "libs/functions.php";
    require "libs/ayar.php";

    
    {
        
       $query = "SELECT id FROM blogs
       ORDER BY RAND()
       LIMIT 1;";

        if ($result = mysqli_query($connection,$query)) {

        $blogsId =  mysqli_fetch_assoc($result);

        header('Location: blog-details.php?id='.control_input($blogsId["id"]));    



        } 
    }
    
    mysqli_close($connection);
    

?>