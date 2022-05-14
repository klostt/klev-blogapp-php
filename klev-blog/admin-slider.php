<?php

    require "libs/vars.php";
    require "libs/functions.php";  
    if(!isAdmin()) {
        header("location: unauthorize.php");
        exit;
    }

?>

<?php include "views/_header.php" ?>
<?php include "views/_message.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">

    <div class="row">

        <div class="col-12">

            <div class="card mb-1">
                <div class="card-body">
                    <a href="slider-create.php" class="btn btn-dark">Slider Ekle</a>
                </div>
            </div>

            <table class="table table-bordered border-secondary align-middle">
                <thead>
                    <tr>
                        <th style="width: 400px;">Resim</th>
                        <th>Slider İsmi</th>
                        <th style="width: 100px;">is active</th>
                        <th style="width: 130px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $result = getSlider();  while($slider = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <img src="img/<?php echo $slider["imageUrl"]?>" alt="" class="img-fluid">
                            </td>
                            <td><?php echo $slider["sliderName"]?></td>                           
                            <td>
                                <?php if($slider["isActive"]):?>
                                    <i class="fas fa-check"></i>
                                <?php else: ?>
                                    <i class="fas fa-times"></i>
                                <?php endif; ?> 
                            </td>
                            <td>
                                <a class="btn btn-dark btn-sm" href="slider-edit.php?id=<?php echo $slider["id"]?>">Düzenle</a>
                                <a class="btn btn-danger btn-sm" href="slider-delete.php?id=<?php echo $slider["id"]?>">Sil</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            

        </div>    
    
    </div>

</div>

<?php include "views/_footer.php" ?>

