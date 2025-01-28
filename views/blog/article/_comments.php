<?php 
    $count_comments = count($article->comments);
    if($count_comments < 10){
        $count_comments = "0" . $count_comments;
    } 
?>

<div class="blog-comment-wrapper mt-55">
    <h4 class="blog-dec-title">comments : <?php echo $count_comments; ?></h4>
    <?php foreach($article->comments as $comment): ?>
        <div class="single-comment-wrapper mt-35">
            <div class="blog-comment-img">
                <img src="/web/img/blog/<?php echo $comment->img; ?>" alt="">
            </div>
            <div class="blog-comment-content">
                <h4><?php echo $comment->name; ?></h4>
                <!-- <span>October 14, 2018 </span> -->
                 <span><?php echo $comment->created; ?></span>
                <p><?php echo $comment->message; ?></p>
                <div class="blog-details-btn">
                    <a href="blog-details.html">read more</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>