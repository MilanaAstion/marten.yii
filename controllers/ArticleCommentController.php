<?php

namespace app\controllers;

use app\models\ArticleComment;
use app\models\Article;
use app\models\ArticleCommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleCommentController implements the CRUD actions for ArticleComment model.
 */
class ArticleCommentController extends Controller
{
    public $layout = 'admin';
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ArticleComment models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArticleCommentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing ArticleComment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleComment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ArticleComment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticleComment::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionArticle($article_id)
    {
        $query = ArticleComment::find()->where(['article_id' => $article_id]); // Создаем запрос

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query, // Передаем запрос
            'pagination' => [
                'pageSize' => 10, // Количество записей на странице (опционально)
            ]
        ]);
        $article = Article::findOne($article_id);
        return $this->render('article', [
            'dataProvider' => $dataProvider,
            'article' => $article
        ]);
    }

    public function actionDeleteComment($id)
    {
        $comment = $this->findModel($id);
        $article_id = $comment->article_id;
        $comment->delete();

        return $this->redirect(['article', 'article_id' => $article_id]);
    }
}
