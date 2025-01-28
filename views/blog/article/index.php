<!-- breadcrumbs -->
<div class="breadcrumb-area pt-95 pb-95 bg-img" style="background-image:url(/web/img/banner/banner-2.jpg);">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Blog Details</h2>
            <ul>
                <li><a href="index.html">home</a></li>
                <li class="active">Blog Details</li>
            </ul>
        </div>
    </div>
</div>
<!-- shop -->
<div class="shop-area pt-100 pb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9 col-md-8">
                <div class="blog-details-wrapper res-mrg-top">
                    <div class="single-blog-wrapper">
                        <div class="blog-img mb-30">
                            <img src="/web/img/blog/<?php echo $article->img; ?>" alt="">
                        </div>
                        <div class="blog-details-content">
                            <h2><?= $article->title; ?></h2>
                            <div class="blog-meta">
                                <ul>
                                    <li><?= date('M - d.m.Y', $article->created); ?></li>
                                    <li>
                                        <a href="#"> 02 Comments</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?= $article->content; ?>
                        
                        <?php echo $this->render('_tags_social'); ?>
                    </div>

                    <?php echo $this->render('_comments', ['article' => $article]); ?>

                    <?php echo $this->render('_form_comment', [ 'comment' => $comment]); ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="shop-sidebar blog-mrg">
                    <div class="shop-widget">
                        <h4 class="shop-sidebar-title">Search Products</h4>
                        <div class="shop-search mt-25 mb-50">
                            <form class="shop-search-form">
                                <input type="text" placeholder="Find a product">
                                <button type="submit">
                                    <i class="icon-magnifier"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="shop-widget mt-50">
                        <h4 class="shop-sidebar-title">Food Category </h4>
                            <div class="shop-list-style mt-20">
                            <ul>
                                <li><a href="#">Canned Food</a></li>
                                <li><a href="#">Dry Food</a></li>
                                <li><a href="#">Food Pouches</a></li>
                                <li><a href="#">Food Toppers</a></li>
                                <li><a href="#">Fresh Food</a></li>
                                <li><a href="#">Frozen Food</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="shop-widget mt-50">
                        <h4 class="shop-sidebar-title">Top Brands </h4>
                            <div class="shop-list-style mt-20">
                            <ul>
                                <li><a href="#">Authority</a></li>
                                <li><a href="#">AvoDerm Natural</a></li>
                                <li><a href="#">Bil-Jac</a></li>
                                <li><a href="#">Blue Buffalo</a></li>
                                <li><a href="#">Castor & Pollux</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="shop-widget mt-50">
                        <h4 class="shop-sidebar-title">Tags </h4>
                            <div class="shop-list-style mt-20">
                            <ul>
                                <li><a href="#">Food </a></li>
                                <li><a href="#">Fish </a></li>
                                <li><a href="#">Dog </a></li>
                                <li><a href="#">Cat  </a></li>
                                <li><a href="#">Pet </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="shop-widget mt-50">
                        <h4 class="shop-sidebar-title">Health Consideration </h4>
                            <div class="shop-list-style mt-20">
                            <ul>
                                <li><a href="#">Bone Development <span>18</span></a></li>
                                <li><a href="#">Digestive Care <span>22</span></a></li>
                                <li><a href="#">General Health <span>19</span></a></li>
                                <li><a href="#">Hip & Joint  <span>41</span></a></li>
                                <li><a href="#">Immune System  <span>22</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="shop-widget mt-50">
                        <h4 class="shop-sidebar-title">Nutritional Option </h4>
                            <div class="shop-list-style mt-20">
                            <ul>
                                <li><a href="#">Grain Free  <span>18</span></a></li>
                                <li><a href="#">Natural <span>22</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="shop-widget mt-50">
                        <h4 class="shop-sidebar-title">Recent Post</h4>
                        <div class="recent-post-wrapper mt-25">
                            <div class="single-recent-post mb-20">
                                <div class="recent-post-img">
                                    <a href="#"><img src="../assets/img/blog/blog-s1.jpg" alt=""></a>
                                </div>
                                <div class="recent-post-content">
                                    <h4><a href="#">My Dog, Aren</a></h4>
                                    <span>April 19, 2018 </span>
                                </div>
                            </div>
                            <div class="single-recent-post mb-20">
                                <div class="recent-post-img">
                                    <a href="#"><img src="../assets/img/blog/blog-s2.jpg" alt=""></a>
                                </div>
                                <div class="recent-post-content">
                                    <h4><a href="#">My Dog, Tomy</a></h4>
                                    <span>April 19, 2018 </span>
                                </div>
                            </div>
                            <div class="single-recent-post mb-20">
                                <div class="recent-post-img">
                                    <a href="#"><img src="/web/img/blog/blog-s3.jpg" alt=""></a>
                                </div>
                                <div class="recent-post-content">
                                    <h4><a href="#">My Dog, Suju</a></h4>
                                    <span>April 19, 2018 </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
