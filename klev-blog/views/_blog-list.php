<?php  
    
    $categoryId = "";
    $keyword = "";
    $page = 1;

    if(isset($_GET["categoryid"]) && is_numeric($_GET["categoryid"])) $categoryId = $_GET["categoryid"];
    if(isset($_GET["q"])) $keyword = control_input($_GET["q"]);
    if(isset($_GET["page"]) && is_numeric($_GET["page"])) $page = $_GET["page"];

    $result = getBlogsByFilters($categoryId, $keyword, $page);
    
?>









<?php if (mysqli_num_rows($result["data"]) > 0): ?>
    
    <div class="row">
        
    <?php while($film = mysqli_fetch_assoc($result["data"])): ?>
        <div class="col-lg-6 p-4">
        <?php if($film["isActive"]): ?>

            <div class="card mb-3">
                <div class="row g-0 ">
                    <div class="col-sm-12 col-md-6 ">
                        <img class="img-fluid" src="img/<?php echo $film["imageUrl"]?>">                          
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="card-body">                        
                            <h5 class="card-title"><a href="blog-details.php?id=<?php echo $film["id"]?>" class="link-secondary" ><?php echo $film["title"]?></a></h5>
                            <?php if($film['imdb_score'] != 0) :?>
                                        <p class="card-text text-muted">Imdb :  <?php echo $film['imdb_score'];?></p>
                                        <?php else :?>
                                            <p class="card-text text-muted">Imdb :  ? </p>
                                    <?php endif;?>
                            <p class="card-text"><?php echo kisaAciklama($film['short_description'],150);?></p>                            
                        </div>
                    
                    </div>
                </div>
            </div>
            </div>
        <?php endif; ?>

    <?php endwhile; ?>
    </div>
<?php else: ?>

    <div class="alert alert-warning">
        Kategoriye ait olan blog bulunamadı.
    </div>

<?php endif; ?>

<?php if ($result["total_pages"] > 1): ?>

<nav aria-label="Page navigation example ">
  <ul class="pagination justify-content-center">
    <?php for ($x = 1; $x <= $result["total_pages"]; $x++): ?>
        <li class="page-item <?php if($x == $page) echo "active" ?>"><a class="page-link border-secondary" href="
        
            <?php
                $url = "?page=".$x;

                if(!empty($categoryId)) {
                    $url .= "&categoryid=".$categoryId;
                }

                if(!empty($keyword)) {
                    $url .= "&q=".$keyword;
                }          
                echo $url;
            
            ?>   

        "><?php echo $x;?></a></li>
    <?php endfor; ?>    
  </ul>
</nav>

<?php endif; ?>