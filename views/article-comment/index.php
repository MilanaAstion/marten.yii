<?php

use app\models\ArticleComment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ArticleCommentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Article Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?//= Html::a('Create Article Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'article_id',
            [
                'attribute' => 'article_id',
                'value' => function ($model) {
                    return $model->article->title;
                }
            ],
            'name',
            'email:email',
            'message:ntext',
            //'img',
            //'created',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ArticleComment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{delete}', // Указываем, какие действия оставить. В данном случае только "удаление"
            ],
        ],
    ]); ?>


</div>
