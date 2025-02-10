<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<!-- breadcrumbs -->
<?php echo $this->render("@app/views/templates/breadcrumbs.php", ["name_page" => $name_page]); ?>
<!-- blog -->
<div class="blog-area pt-100 pb-100 clearfix">
    <div class="container">
        <div class="row">
            <?php foreach($articles as $article): ?>
                <div class="col-lg-6 col-md-6">
                    <div class="blog-wrapper mb-30 gray-bg">
                        <div class="blog-img hover-effect">
                            <a href="<?php echo Url::to(['article/' . $article->id]); ?>">
                                <!-- <img alt="" src="/web/img/blog/<?//= $article->img ?>"> -->
                                <?php echo Html::img('@web/img/blog/' . $article->img, ['alt' => $article->title]); ?>
                            </a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <ul>
                                    <li>By: <span><?= $article->author ?></span></li>
                                    <li><?= date('M - d.m.Y', $article->created); ?></li>
                                </ul>
                            </div>
                            <!-- <h4><a href="article/<?//= $article->id ?>"><?//= $article->title ?></a></h4> -->
                            <h4><?php echo Html::a($article->title, ['article/' . $article->id]); ?></h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- <div class="pagination-style text-center mt-20">
            <ul>
                <li>
                    <a href="#"><i class="icon-arrow-left"></i></a>
                </li>
                <li>
                    <a href="#">1</a>
                </li>
                <li>
                    <a href="#">2</a>
                </li>
                <li>
                    <a class="active" href="#"><i class="icon-arrow-right"></i></a>
                </li>
            </ul>
        </div> -->

        <div class="pagination-style text-center mt-20">
        <?= LinkPager::widget([
            'pagination' => $pages,
            'options' => ['class' => ''], // Настройка основного контейнера ul
            'linkOptions' => ['class' => ''], // Общий класс для ссылок
            'prevPageLabel' => '<i class="icon-arrow-left"></i>', // Иконка для "предыдущая"
            'nextPageLabel' => '<i class="icon-arrow-right"></i>', // Иконка для "следующая"
            'activePageCssClass' => 'active', // Класс для активной страницы
            'disabledPageCssClass' => 'disabled', // Класс для отключённых ссылок
            'firstPageCssClass' => 'first', // Класс для первой страницы
            'lastPageCssClass' => 'last', // Класс для последней страницы
            'maxButtonCount' => 5, // Количество отображаемых кнопок
            'nextPageCssClass' => '', // Класс для кнопки "следующая"
            'prevPageCssClass' => '', // Класс для кнопки "предыдущая"
            'pageCssClass' => '', // Класс для кнопок страниц
            'prevPageCssClass' => 'prev',
            'nextPageCssClass' => 'next',
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'disabled'], // Для disabled
        ]); ?>
        </div>

        <?php
        // Использование LinkPager с настройками
        // echo LinkPager::widget([
        // 'pagination' => $pages,
        // 'firstPageLabel' => "first",
        // 'prevPageLabel' => "prev",
        // 'linkOptions' => ["class" => 'test item-link'],
        // 'linkContainerOptions' => ["class" => 'test'],
        // 'options' => ["class" => 'pagination-style text-center mt-20'],
        // ]);
        ?>
    </div>
</div>