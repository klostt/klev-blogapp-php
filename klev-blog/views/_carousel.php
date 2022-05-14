<?php 
      $result = getSlider();
?>           
<?php if ($result->num_rows > 0) :?>

  <div id="carouselExampleSlidesOnly" class="carousel slide mb-5 carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">

    <?php
    
      $x = 0;

    ?>

    <?php while($slide = mysqli_fetch_assoc($result)): ?>
        <?php if($slide["isActive"]) :?>

          <?php 
            
            if($x == 0){
              $x++;
            
            }

            ?>
      
          <div class="carousel-item <?php echo ($x==1) ? 'active':'' ; $x = 2?>">
            <img src="img/<?php echo $slide["imageUrl"] ?>" class="d-block w-100" alt="<?php echo $slide["sliderName"] ?>">
          </div>
        <?php endif;?>

      <?php endwhile;?>
  
    </div>
   
  </div>
<?php endif;?>




