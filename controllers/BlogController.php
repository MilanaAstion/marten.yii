<?php

namespace app\controllers;
use app\models\Article;
use app\models\Category;
use yii\data\Pagination;

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
        $article = Article::findOne($id); 
    
        return $this->render('article', [
            'article' => $article, 
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
}
