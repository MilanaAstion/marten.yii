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


    public function actionArticle($id)
    {
        $name_page = "Blog Datails";
        // $article = Article::findOne($id); 
        $article = Article::find()->with('comments')->where(['id' => $id])->one();
        $comment = new ArticleComment;
        $comment->article_id = $article->id;
        // dd($article->comments);
        return $this->render('article/index', [
            'article' => $article,
            'comment' => $comment,
            "name_page" => $name_page,
        ]);
    }

    public function actionArticles()
    {
        // $articles = Article::find()->all(); 
        $name_page = "Blog Page";
        $query = Article::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 2]);
        $articles = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('articles', [
            'articles' => $articles, 
            'pages' => $pages,
            "name_page" => $name_page,
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
