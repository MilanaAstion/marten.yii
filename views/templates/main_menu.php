<?php  use yii\helpers\Html; ?>

<div class="main-menu text-center">
    <nav>
        <ul>
            <li>
                <a href="/">HOME</a>
            </li>
            <li class="mega-menu-position"><a href="/shop">Food</a>
                <ul class="mega-menu">
                    <?php foreach($this->params['categories'] as $category): ?>
                        <li>
                            <ul>
                                <li class="mega-menu-title"><?= $category->name; ?></li>
                                <?php foreach($category->children as $sub_category): ?>
                                    <li><a href="/shop/category/<?= $sub_category->id; ?>"><?= $sub_category->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li>
                <a href="/blog">Blog</a>
            </li>
            <li><a href="about-us.html">ABOUT</a></li>
            <li><a href="contact.html">contact us</a></li>
            <li><?php echo Html::a('admin', ['admin/products']); ?></li>
        </ul>
    </nav>
</div>