<hr>
<h4 class="text-center">Yorumlar</h4>

    <?php if(isLoggedin()) : ?>
        <p class="my-1 text-muted">Merhaba, <?php  echo $_SESSION["username"] ?></p>
        <form action="" method="post" class="mb-4">
            <textarea name="comment_text" id="" cols="30" rows="2" class="form-control <?php echo (!empty($comment_err)) ? "is-invalid" : ""  ?>" placeholder="Yorumunuzu Giriniz."></textarea>
            <span class="invalid-feedback"><?php echo $comment_err ?></span>
            <div class="text-muted my-1"><?php echo $comment_info ?></div>
            <button type="submit" class="btn btn-dark mt-2">Yorum Yap</button>

         </form>
    <?php else :?>
        <p class="text-muted text-center">Yorum Yapmak İçin <a href="login.php" class="link-success">Giriş Yapınız.</a></p>
    <?php endif; ?>

    <?php $comments = getCommentsByBlogId($blog["id"]); while( $comment = mysqli_fetch_assoc($comments)) : ?>
        <?php if( $comment["comment_isActive"]) :?>

        <div class="card  mb-3">
            <div class="card-header"> <span class="text-secondary"> <?php 
                $result = getUsername($comment["user_id"]);
                if($user = mysqli_fetch_assoc($result)){
                    echo $user["username"];
                }
            
            ?></span> </div>
            <div class="card-body">
                <p class="py-1 m-0"><?php echo $comment["comment_text"] ?></>
            </div>
            <div class="card-footer">
            <span class="text-muted">
                <?php echo $comment["dateAdded"] ?>
            </span>
                
            </div>
        </div>
            <?php endif; ?>


    <?php endwhile;?>