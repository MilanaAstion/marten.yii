<?php

use app\models\Article;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ArticleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
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
            //'content:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Article $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
