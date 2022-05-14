<?php

    require "libs/vars.php";
    require "libs/functions.php";  

?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">

    <div class="row">
        


    

     





        <div class="col-md-9">                
        
        <h1 class="mb-4 h5 text-start d-block">Tüm Bloglar ;  <button class="d-block d-md-none  btn text-secondary float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-funnel"></i> Filtreleme</button></h1>
            <div class="offcanvas offcanvas-end bg-dark text-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">

                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Filtreleme</h5>
                    <button type="button" class="btn-close text-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                     <?php include "views/_menu.php" ?>        
                </div>
            </div> 
            
                <?php include "views/_blog-list.php" ?>   
        </div> 

        <div class="col-md-3 d-none d-md-block">
            <?php include "views/_menu.php" ?>                 
        </div>
           
    
    </div>

</div>


<?php include "views/_footer.php" ?>

