<?php
    require "libs/vars.php";
    require "libs/functions.php";  
    if(!isAdmin()) {
        header("location: unauthorize.php");
        exit;
    }
    $slidername= $image = "";
    $slidername_err = $image_err = "";

    if ($_SERVER["REQUEST_METHOD"]=="POST") {

        $input_slidername = trim($_POST["slidername"]);
        $isActive = isset($_POST["isActive"]) ? 1 : 0;

        if(empty($input_slidername)) {
            $slidername_err = "Slider Name boş geçilemez.";
        } else if (strlen($input_slidername) > 150) {
            $slidername_err = "Slider Name için çok fazla karakter girdiniz.";
        }
        else {
            $slidername = control_input($input_slidername);
        }
        if (empty($_FILES["image"]["name"])) {
            $image_err = "dosya seçiniz";
        } else {
            $result = saveImage($_FILES["image"]);

            if($result["isSuccess"] == 0) {
                $image_err = $result["message"];
                
            } else {
                $image = $result["image"];
            }
        }

        if(empty($slidername_err)) {
            if (createSlider($slidername, $image, $isActive)) {
                $_SESSION['message'] = $slidername." isimli slider eklendi";
                $_SESSION['type'] = "success";
                
                header('Location: admin-slider.php');
            } else {
                echo "hata";
            }
        }   

        
     
    }
?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">

    <div class="row">
        
        <div class="col-12">

           <div class="card">
        <div class="card-header"><h1 class="h3 text-center m-0">Slider Create </h1></div>
           
                <div class="card-body">
                    <form action="slider-create.php" method="POST" enctype="multipart/form-data">
                      
                        
                        <div class="mb-3">
                                <label for="slidername" class="form-label">Slider Name</label>
                            <input type="text" name="slidername" id="slidername" class="form-control <?php echo (!empty($slidername_err)) ? 'is-invalid':'' ?>" value="<?php echo $slidername;?>">                            
                            <span class="invalid-feedback"><?php echo $slidername_err?></span>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Slider image</label>
                            <input type="file"  name="image" id="image" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid':'' ?>" >
                            <span class="invalid-feedback"><?php echo $image_err?></span>
                            <span class="text-muted">* Lütfen Resimlerinizi 1920x500 ölçüsünde ve 10mb'den düşük seçiniz. </span>
                        </div>

                        <div class="form-check my-3">
                                <label for="isActive" class="form-check-label">is active</label>
                                <input type="checkbox" class="form-check-input" name="isActive" id="isActive">
                            </div>     

                        <input type="submit" value="Submit" class="btn btn-dark">


                    
                    </form>
                </div>
            </div>

        </div>    
    
    </div>

</div>

<?php include "views/_footer.php" ?>

