<?php

    require "libs/vars.php";
    require "libs/functions.php";  
    if(!isLoggedin()) {
        header("location: login.php");
        exit;
    }


?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>
<div class="profile-bg">
    
    <div class="container my-3 ">
    
        <div class="row ">
         
            <div class="col-12 text-center my-5 log">
        
               <h3>Merhaba, <?php echo htmlspecialchars($_SESSION["username"])?></h3>
               <p class="text-muted"> Kullanıcı Id'niz : <?php echo $_SESSION["id"] ?></p>
               <div>
                    <a href="logout.php" class="btn btn-sm btn-danger">Çıkış Yap</a>
                    <a href="index.php" class="btn btn-sm btn-primary"> Devam Et </a>
               </div>
    
            </div>    
        
        </div>
    
    </div>

</div> 

<?php include "views/_footer.php" ?>