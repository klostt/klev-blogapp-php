<?php
    require "libs/vars.php";
    require "libs/functions.php";  
    if(!isAdmin()) {
        header("location: unauthorize.php");
        exit;
    }
    
    $title =  $imdb_err = $description = $category = $image = "";
    $title_err = $imdb = $description_err = $category_err = $image_err = "";

    $categories = getCategories();

    if ($_SERVER["REQUEST_METHOD"]=="POST") {

        // validate title

        $input_title = trim($_POST["title"]);

        if(empty($input_title)) {
            $title_err = "title boş geçilemez.";
        } else if (strlen($input_title) > 150) {
            $title_err = "title için çok fazla karakter girdiniz.";
        }
        else {
            $title = control_input($input_title);
        }

        // validate description

        $input_description = trim($_POST["description"]);

        if(empty($input_description)) {
            $description_err = "description boş geçilemez.";
        } else if (strlen($input_description) < 10) {
            $description_err = "description için çok az karakter girdiniz.";
        }
        else {
            $description = control_input($input_description);
        }

        $input_imdb = trim($_POST["imdb"]);

        if(empty($input_description)) {
            $input_imdb_err = "Imdb boş geçilemez.";
        }
        else {
            $imdb = (int) control_input($input_imdb);
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



        $sdescription = $_POST["sdescription"];
        $url = $_POST["url"];

        if(empty($title_err) && empty($description_err)) {
            if (createBlog($title,$imdb,$sdescription, $description, $image, $url)) {
                $_SESSION['message'] = $title." isimli blog eklendi";
                $_SESSION['type'] = "success";
                
                header('Location: admin-blogs.php');
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
                <div class="card-header">
                    <p class="h3 m-0">
                        Blog Oluştur
                    </p>
                </div>
                <div class="card-body">
                    <form action="blog-create.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="title" class="form-label">Başlık</label>
                            <input type="text" name="title" id="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid':'' ?>" value="<?php echo $title;?>">
                            <span class="invalid-feedback"><?php echo $title_err?></span>
                        </div>

                        <div class="mb-3">
                            <label for="sdescription" class="form-label">İmdb Puanı </label>
                            <input type="number" name="imdb" id="imdb" step="0.01" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="sdescription" class="form-label">Kısa Açıklama</label>
                            <textarea name="sdescription" id="sdescription" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Açıklama</label>
                            <textarea name="description" id="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid':'' ?>"><?php echo $description;?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err?></span>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Resim</label>
                            <input type="file"  name="image" id="image" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid':'' ?>" >
                            <span class="invalid-feedback"><?php echo $image_err?></span>
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">url</label>
                            <input type="text" class="form-control" name="url" id="url">
                        </div>                        

                        <input type="submit" value="Oluştur" class="btn btn-dark">
                    
                    </form>
                </div>
            </div>

        </div>    
    
    </div>

</div>

<?php include "views/_ckeditor.php" ?>
<?php include "views/_footer.php" ?>

