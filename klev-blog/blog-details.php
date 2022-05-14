<?php

    require "libs/vars.php";
    require "libs/functions.php";  
    $blog_id = $_GET["id"];

    if(!isset($blog_id) or !is_numeric($blog_id)) {
        header('Location: index.php');
    }

    if (isLoggedin()) {
        $user_id = $_SESSION["id"];
    }

    $result = getBlogById($blog_id);
    $blog = mysqli_fetch_assoc($result);

    if(!$blog) {
        header('Location: index.php');
    }

    //comment 
        $comment_err = $comment_info =  "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $comment_text = control_input($_POST["comment_text"]);

            if (empty($comment_text)) {
                $comment_err = "Lütfen Yorum giriniz.";
            } elseif (strlen($comment_text) < 10) {
                $comment_err = "Yetersiz Yorum Uzunluğu .";
            }else {
                if ($comment = addComments($user_id,$blog_id,$comment_text)) {
                    echo "TRUE";
                }else{
                    $comment_info = "* Mesajın Adminler Tarafından Onaylandıktan Sonra Yayınlanacaktır. Yorumlarınız için teşekkür ederiz.";
                }
                
                
            }            
        }

?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>
<?php include "views/_message.php" ?>

<div class="container my-3">

    <div class="row">

        <div class="col-12">

            <div class="card p-1">
                <div class="row g-0">
                    <div class="col-md-3 p-4 ">
                        <div class=" img-thumbnail border-dark">
    
                            <img class="img-fluid" src="img/<?php echo $blog["imageUrl"] ?>" alt="<?php echo $blog["title"] ?>">
                            <p class="m-0 py-1 text-center "><?php echo $blog["title"]?></p> 
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h1 class="card-title"><?php echo $blog["title"] ?></h1>
                            <p class="card-text"><?php echo htmlspecialchars_decode($blog["short_description"]) ?></p>
                            <hr>
                            <p class="card-text"><?php echo htmlspecialchars_decode($blog["description"]) ?></p>
                        </div>
                    </div>
                </div>
            </div>
           <?php include "views/_comments.php" ?>
        </div>    
    
    </div>

</div>

<?php include "views/_footer.php" ?>

