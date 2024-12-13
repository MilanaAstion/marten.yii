<?php

use app\models\ProductImage;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'Product Images: ' . $product->name;

$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['/admin/products']];
$this->params['breadcrumbs'][] = ['label' => 'Product', 'url' => ['/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-image-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Image', ['create', "prod_id" => $product->id], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'image',
                'format' => 'html',
                'filter' => false,
                'value' => function ($model) {
                    // return $model->images[0]->image;
                    return Html::img('@web/img/product/min/' . $model->image, ['height' => '70px']);
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{delete}',
                'urlCreator' => function ($action, ProductImage $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
