<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Article $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

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
        <?= Html::a('Comments', ['article-comment/article', 'article_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'img',
                'format' => 'html',
                'value' => function ($model) {
                    $imageUrl = Yii::getAlias('@web') . '/img/blog/' . $model->img;
                    return Html::img($imageUrl, ['style' => 'width:100px;']);
                },
                'filter' => false, 
            ],
            'author',
            [
                'attribute' => 'created',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created, 'php:d.m.Y H:i');
                },
                'filter' => false, 
            ],
            [
                'attribute' => 'content',
                'format' => 'html', 
                'value' => function ($model) {
                    return $model->content; 
                },
            ],
        ],
    ]) ?>

</div>
