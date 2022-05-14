<?php
    AAAAAAAAAA
    require "libs/vars.php";
    require "libs/functions.php";  

?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>


<?php include "views/_carousel.php" ?>
    
<div class="container my-3">
<h1 class="mb-4 h3 text-start d-block">Başlıca Bloglar ;  <button class="d-block d-md-none btn text-secondary float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-funnel"></i> Filtreleme</button></h1>

        <div class="offcanvas offcanvas-end bg-dark text-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Filtreleme</h5>
            <button type="button" class="btn-close text-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <?php include "views/_menu.php" ?>     

        </div>
        </div>    

  

    <div class="row">

        <div class="col-md-9 p-4">

            <?php  
                $result = getHomePageBlogs(); 
            ?>

            <?php if (mysqli_num_rows($result) > 0): ?>

                    
                <?php while($film = mysqli_fetch_assoc($result)): ?>

                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-lg-3">
                                <img class="img-fluid rounded-start" src="img/<?php echo $film["imageUrl"]?>">                          
                            </div>
                            <div class="col-9 d-flex flex-column justify-items-between">
                            <a href="blog-details.php?id=<?php echo $film["id"]?>" class="link-secondary"> <div class="card-header">
                                    <h3 class="card-title my-1 text-secondary"><?php echo $film["title"]?></h3>
                                </div></a>
                                
                                <div class="card-body">                        
                                    <?php if($film['imdb_score'] != 0) :?>
                                        <p class="card-text text-muted">Imdb :  <?php echo $film['imdb_score'];?></p>
                                        <?php else :?>
                                            <p class="card-text text-muted">Imdb :  ? </p>
                                    <?php endif;?>

                                    <p class="card-text"><?php echo kisaAciklama($film['short_description'],200);?></p>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text">
                                        <small class="text-muted mt-auto"><?php echo $film["dateAdded"]?></small>
                                    </p>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    
                    <?php endwhile; ?>
                    <a href="blogs.php" class="btn btn-dark">Tümünü Gör ...</a>
            <?php else: ?>

                <div class="alert alert-warning">
                    Kategoriye ait olan blog bulunamadı.
                </div>

            <?php endif; ?> 

        </div>  
        <div class="d-none d-md-block col-3">
        
            <?php include "views/_menu.php" ?>     

            
        </div>  
    
        
    
    </div>

</div>

<?php include "views/_footer.php" ?>

