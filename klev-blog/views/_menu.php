<?php


    if(isset($_GET["categoryid"]) && is_numeric($_GET["categoryid"])) {
        $selectedCategory = $_GET["categoryid"];
    }

?>



<ul class="list-group category">
    <h3 class="text-muted">Kategoriler : </h3>
    <a href='blogs.php' class="list-group-item list-group-item-action">Tüm Kategoriler</a>

    <?php $result = getCategories();  while($item = mysqli_fetch_assoc($result)): ?>

        <?php if ($item["isActive"]): ?>
        
            <a href='<?php echo "blogs.php?categoryid=".$item["id"]?>' class="list-group-item list-group-item-action
            
                <?php           
                if (isset($selectedCategory)) {
                    if($item["id"] == $selectedCategory) {
                        echo "active";
                    } 
                }      
                                   
                ?>            
            
            ">
                <?php echo ucfirst($item["name"])?>
            </a>  
            
        <?php endif; ?>
    <?php endwhile; ?>
</ul>

<a href="random-blog.php" class="btn btn-lg btn-secondary shadow-lg my-4 d-table mx-auto "><i class="bi bi-shuffle"></i> Rastgele Blog</a>


<div class="card ">
    <div class="card-header">
        <p class="m-0">Son Eklenenler : </p>
    </div>
    <div class="card-body">
    <?php $last = getLastBlogs(); while( $lastBlog = mysqli_fetch_assoc($last)) : ?>
        <a href="blog-details.php?id=<?php echo $lastBlog["id"] ?>"  class ="link-secondary"><?php echo $lastBlog["title"]?></a> <br>
        
        <?php endwhile;?>
    </div>
</div>

