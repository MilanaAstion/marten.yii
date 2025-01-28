<?php

namespace app\controllers;
use app\models\Article;
use app\models\ArticleComment;
use app\models\Category;
use yii\data\Pagination;
use Yii;

class BlogController extends \yii\web\Controller
{
    public $layout = 'public';

    public function beforeAction($action)
    {
        $this->view->params['categories'] = Category::buildTree();
        
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionArticle($id)
    {
        // $article = Article::findOne($id); 
        $article = Article::find()->with('comments')->where(['id' => $id])->one();
        $comment = new ArticleComment;
        $comment->article_id = $article->id;
        // dd($article->comments);
        return $this->render('article/index', [
            'article' => $article,
            'comment' => $comment,
        ]);
    }

    public function actionArticles()
    {
        // $articles = Article::find()->all(); 
        
        $query = Article::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 2]);
        $articles = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('articles', [
            'articles' => $articles, 
            'pages' => $pages,
        ]);
    }

    public function actionSaveComment()
    {
        $data = Yii::$app->request->post();
        $model = new ArticleComment();
        $model->load($data, '');
        $model->name = $data["author"];
        $model->img = "blog-comment2.png";
        $model->created = time();
        $result = $model->save();
        return $this->redirect(['article', 'id' => $model->article_id]);
    }
}
