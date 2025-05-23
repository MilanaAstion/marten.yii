<?php 
    $currentPage = $pages->page + 1;
?>
<?php echo $this->render("@app/views/templates/breadcrumbs.php", ["name_page" => $name_page]); ?>

<div class="shop-area pt-100 pb-100 gray-bg">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="shop-topbar-wrapper">
                    <div class="product-sorting-wrapper">
                        <div class="product-show shorting-style">
                            <label>Showing <span>1-20</span> of <span>100</span> Results</label>
                            <select>
                                <option value="">12</option>
                                <option value="">24</option>
                                <option value="">36</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid-list-options">
                        <ul class="view-mode">
                            <li><a href="#product-grid" data-view="product-grid"><i class="ti-layout-grid4-alt"></i></a></li>
                            <li class="active"><a href="#product-list" data-view="product-list"><i class="ti-align-justify"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="grid-list-product-wrapper">
                    <div class="product-view product-list">
                        <div class="row">
                        <?php foreach($products as $product): ?>
                            <div class="product-width col-lg-6 col-xl-4 col-md-6 col-sm-6">
                                <div class="product-wrapper mb-10">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img src="/web/img/product/card/<?php echo $product->images[0]->image; ?>" alt="">
                                        </a>
                                        <div class="product-action">
                                            <a title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                                <i class="ti-plus"></i>
                                            </a>
                                            <a title="Add To Cart" href="#">
                                                <i class="ti-shopping-cart"></i>
                                            </a>
                                        </div>
                                        <div class="product-action-wishlist">
                                            <a title="Wishlist" href="#">
                                                <i class="ti-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4><a href="product-details.html"><?php echo $product->name; ?></a></h4>
                                        <div class="product-price">
                                            <span class="new">$<?php echo $product->price; ?>.00 </span>
                                            <?php if($product->old_price): ?>
                                                <span class="old">$<?php echo $product->old_price; ?>.00</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="product-list-content">
                                        <h4><a href="#"><?php echo $product->name; ?></a></h4>
                                        <div class="product-price">
                                            <span class="new">$<?php echo $product->price; ?>.00 </span>
                                        </div>
                                        <p><?php echo $product->descr; ?></p>
                                        <div class="product-list-action">
                                            <div class="product-list-action-left">
                                                <a class="addtocart-btn" title="Add to cart" href="#"><i class="ion-bag"></i> Add to cart</a>
                                            </div>
                                            <div class="product-list-action-right">
                                                <a title="Wishlist" href="#"><i class="ti-heart"></i></a>
                                                <a title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#"><i class="ti-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <div class="pagination-style text-center mt-10">
                            <ul>
                                <?php if($currentPage > 1): ?>
                                    <li>
                                        <a href="/shop?page=<?php echo $currentPage - 1; ?>"><i class="icon-arrow-left"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php for($i=1; $i<=$pages->pageCount; $i++): ?>
                                        <li  class="<?php if($currentPage == $i) echo 'active'; ?>">
                                                <a href="/shop?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>  
                                <?php endfor; ?>
                                <?php if($currentPage < $pages->pageCount): ?>
                                    <li>
                                        <a href="/shop?page=<?php echo $currentPage + 1; ?>"><i class="icon-arrow-right"></i></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="shop-sidebar">
                    <div class="shop-widget">
                        <h4 class="shop-sidebar-title">Search Products</h4>
                        <div class="shop-search mt-25 mb-50">
                            <form class="shop-search-form" action="main/search" method="post">
                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                                <input type="text" placeholder="Find a product" name="search">
                                <button type="submit">
                                    <i class="icon-magnifier"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="shop-widget">
                        <h4 class="shop-sidebar-title">Filter By Price</h4>
                            <div class="price_filter mt-25">
                            <div id="slider-range"></div>
                            <div class="price_slider_amount">
                                <div class="label-input">
                                    <label>price : </label>
                                    <input type="text" id="amount" name="price"  placeholder="Add Your Price" />
                                </div>
                                <button type="button">Filter</button> 
                            </div>
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
                </div>
            </div>
        </div>
    </div>
</div>
