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

            

            <table class="table border-secondary table-bordered">
                <thead>
                    <tr>
                        <th style="width: 80px;">Blog</th>
                        <th style="width: 100px;">Kullancı Id</th>
                        <th>Yorum</th>
                        <th style="width: 100px;">Onay</th>
                        <th style="width: 150px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $result = getComments();  while($comment = mysqli_fetch_assoc($result)): ?>
                        <tr class="align-middle text-center">
                                <?php 
                                $result_blog = getCategoryById($comment["comment_id"]);
                                $selectedCategory = mysqli_fetch_assoc($result_blog);   
                                $comment_result = getBlogById($comment["blog_id"]);
                                while($blog = mysqli_fetch_assoc($comment_result)) : ?>
                                  <td>
                                    <img src="img/<?php echo $blog["imageUrl"];?>" class="img-fluid img-thumbnail" alt="<?php echo $blog["title"]?>">
                                    </td>
                                <?php endwhile; ?>
                            <td><?php echo $comment["user_id"]?></td>
                            <td><?php echo  kisaAciklama($comment["comment_text"],250)?></td>

                            <td>
                                <?php if($comment["comment_isActive"]): ?>
                                    <i class="fas fa-check"></i>
                                <?php else: ?>
                                    <i class="fas fa-times"></i>
                                <?php endif; ?>
                            </td>
                           
                            <td>
                                <a class="btn btn-dark btn-sm" href="comment-edit.php?id=<?php echo $comment["comment_id"]?>">Düzenle</a>
                                <a class="btn btn-danger btn-sm" href="comment-delete.php?id=<?php echo $comment["comment_id"]?>">Sil</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            
            <script>
                var $copyContainer = $(".copy-container"),
    $replayIcon = $('#cb-replay'),
    $copyWidth = $('.copy-container').find('p').width();

var mySplitText = new SplitText($copyContainer, {type:"words"}),
    splitTextTimeline = new TimelineMax();
var handleTL = new TimelineMax();

// WIP - need to clean up, work on initial state and handle issue with multiple lines on mobile

var tl = new TimelineMax();

tl.add(function(){
  animateCopy();
  blinkHandle();
}, 0.2)

function animateCopy() {
  mySplitText.split({type:"chars, words"}) 
  splitTextTimeline.staggerFrom(mySplitText.chars, 0.001, {autoAlpha:0, ease:Back.easeInOut.config(1.7), onComplete: function(){
    animateHandle()
  }}, 0.05);
}

function blinkHandle() {
  handleTL.fromTo('.handle', 0.4, {autoAlpha:0},{autoAlpha:1, repeat:-1, yoyo:true}, 0);
}

function animateHandle() {
  handleTL.to('.handle', 0.7, {x:$copyWidth, ease:SteppedEase.config(12)}, 0.05);
}

$('#cb-replay').on('click', function(){
  splitTextTimeline.restart()
  handleTL.restart()
})
            </script>
        </div>    
    
    </div>

</div>

<?php include "views/_footer.php" ?>

