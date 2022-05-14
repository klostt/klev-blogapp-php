<?php
    require "libs/vars.php";
    require "libs/functions.php";  
    if(!isAdmin()) {
        header("location: unauthorize.php");
        exit;
    }
    $id = $_GET["id"];    
    $result = getSliderById($id);
    $selectedSlide = mysqli_fetch_assoc($result);    


    $image_err = "";

    if ($_SERVER["REQUEST_METHOD"]=="POST") {

        $sliderName = $_POST["sliderName"];        
        $imageUrl = $_POST["imageUrl"];
        $isActive = isset($_POST["isActive"]) ? 1 : 0;

        if (!empty($_FILES["image"]["name"])) {
            $result = saveImage($_FILES["image"]);
            
            if($result["isSuccess"] == 0) {                
                $image_err = trim($result["message"]);
            }else {                
                $imageUrl = $result["image"]; 
                
            }            
        }
        
        if (editSlider($id, $sliderName,$imageUrl,$isActive)) {                    
            
            $_SESSION['message'] = $sliderName." isimli blog güncellendi.";
            $_SESSION['type'] = "success";

            header('Location: admin-slider.php');
        } else {
            echo "<div class = \"alert alert-danger text-center m-0\" >$image_err </div>";
        }

    }
?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">

    <div class="card">
           
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                
                    <div class="col-12">

                        <div id="edit-form">

                                <div class="mb-3">
                                    <label for="title" class="form-label">Slider Name</label>
                                    <input type="text" class="form-control" name="sliderName" id="sliderName" value="<?php echo $selectedSlide["sliderName"]?>">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">image</label>
                                    <input type="file"  name="image" id="image" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid':'' ?>" >
                                    <span class="text-muted">* Dosya boyutu en fazla 10mb olabilir ! </span>
                                    <span class="invalid-feedback"><?php echo $image_err?></span>
                                </div>


                                <input type="submit" value="Submit" class="btn btn-dark">

                            
                        </div>

                    </div>   
                    <div class="col-12">
                        <hr>
                        <input type="hidden" name="imageUrl" value="<?php echo $selectedSlide["imageUrl"]?>">
                        <img class="img-fluid" src="img/<?php echo $selectedSlide["imageUrl"]?>" alt="">                                            
                        <div class="form-check mb-3">
                            <label for="isActive" class="form-check-label">is active</label>
                            <input type="checkbox" class="form-check-input" name="isActive" id="isActive" <?php if ($selectedSlide["isActive"]) {echo "checked";}?>>
                        </div>    
                    </div> 
                    
                
                </div>
            </form>

        </div>
    </div>
</div>

<?php include "views/_ckeditor.php" ?>
<?php include "views/_footer.php" ?>

