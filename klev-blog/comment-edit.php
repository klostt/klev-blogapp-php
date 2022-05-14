<?php
    require "libs/vars.php";
    require "libs/functions.php";  
    if(!isAdmin()) {
        header("location: unauthorize.php");
        exit;
    }

    

    $comment_err = "";
    $id = $_GET["id"];
   
    $result = getCommentsById($id);
    $selectedComment = mysqli_fetch_assoc($result);    
    
    $isActive = isset($_POST["isActive"]) ? 1 : 0;

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        if(isset($_POST["comment"])){
            if (empty($_POST["comment"])) {
                $comment_err = "Yorumu Boş Olarak Güncelleyemezsiniz.";                   
            }else{
                $comment_text = $_POST["comment"];                  
            }
        }
        if(empty($comment_err)){
        if (editComment($id, $isActive, $comment_text)) {

                        $_SESSION['message'] = $id." id numaralı yorum güncellendi.";
                        $_SESSION['type'] = "success";

                        header('Location: admin-comments.php');
                    } else {
                        echo "hata";
                    }
            
        }
            
        
    }
?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">

        
        <div class="card">
        
             <div class="card-body">
    <div class="row">

                    <div class="col-9">

                    <form method="POST">

                        <div class="mb-3">
                            <p class="h5">Yorum : </p>
                            <p><?php echo $selectedComment["comment_text"]?></p>
                            <p class="h6">Düzenle : </p>

                            
                            
                            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control form-control <?php echo (!empty($comment_err) ? "is-invalid" : '')?>"><?php echo (empty($comment_err)) ?$selectedComment["comment_text"] : ''?></textarea>
                            <span class="invalid-feedback"><?php echo $comment_err?></span>
                        </div>
                     
                        <div class="form-check mb-3">
                                <label for="isActive" class="form-check-label">Confirm</label>
                                
                                <input type="checkbox" class="form-check-input" name="isActive" id="isActive" <?php if ($selectedComment["comment_isActive"]) {echo "checked";}?>>
                            </div> 

                        <input type="submit" value="Submit" class="btn btn-dark">

                    
                    </div>
                    <div class="col-3">

                             <?php 
                                $comment_result = getBlogById($selectedComment["blog_id"]);
                                if($blog = mysqli_fetch_assoc($comment_result)) : ?>
                                    <p class="text-center text-muted m-0">Yorum Yapılan Film</p>
                                    <hr>
                                  
                                    <img src="img/<?php echo $blog["imageUrl"];?>" class="img-fluid img-thumbnail" alt="<?php echo $blog["title"]?>">
                                    <p class="text-center text-muted m-0"><?php echo $blog["title"]?></p>
                                <?php endif; ?>
                            
                            
                            
                                

                        </div>
                    </form>
            </div>

        </div>    
    
    </div>

</div>

<?php include "views/_footer.php" ?>

