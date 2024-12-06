<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Category;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Images', ['/product/images', 'prod_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            'descr:ntext',
            'popular',
        ],
    ]) ?>

</div>
