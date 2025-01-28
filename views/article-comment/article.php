<?php

use app\models\ArticleComment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ArticleCommentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Comments for '.$article->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'email:email',
            'message:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ArticleComment $model, $key, $index, $column) {
                    if ($action === 'delete') {
                        return Url::toRoute(['delete-comment', 'id' => $model->id]); // Заменяем delete на delete-comment
                    }
                },
                'template' => '{delete}', // Указываем, какие действия оставить. В данном случае только "удаление"
            ],
        ],
    ]); ?>


</div>
