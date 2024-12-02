<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Category;

/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return  $model->price . '$'; // Добавляем символ доллара перед значением
                },
            ],
            [
                'attribute' => 'old_price',
                'value' => function ($model) {
                    return $model->old_price ? $model->old_price . '$' : null; // Проверяем наличие old_price
                },
            ],
            [
                'attribute' => 'cat_id',
                'value' => function ($model) {
                    return $model->category->name;
                },
                'filter' => ArrayHelper::map(Category::find()->where(['!=', 'parent_id', Category::MAIN_PARENT_ID])->all(), 'id', 'name'),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt' => 'Выберите категорию',
                ],
            ],
            [
                'attribute' => 'img',
                'format' => 'html',
                'filter' => false,
                'value' => function ($model) {
                    // return $model->images[0]->image;
                    return Html::img('@web/img/product/min/' . $model->images[0]->image, ['height' => '70px']);
                },
            ],
            //'descr:ntext',
            //'popular',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
