<?php

namespace app\controllers;
use Yii;
use app\models\Category;
use app\models\Product;
use app\models\Article;
use app\models\ProductImage;

class MainController extends \yii\web\Controller
{
    
    public $layout = 'public';
    
    public function beforeAction($action)
    {
        $this->view->params['categories'] = Category::buildTree();
        
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        // $cats = Category::buildTree();
        // dd($cats);
        $popular_products = Product::find()->with('images')->where(['popular' => Product::POPULAR_ID])->all();
        $articles = Article::find()->orderBy(['id' => SORT_DESC])->limit(3)->all();
        // ->where(['popular' => Product::POPULAR_ID])
        // foreach($popular_products as $popular_product){
        //     dd($popular_product->images);
        // }
        // $products = Product::find()->all();
        // foreach($products as $product){
        //     echo $name = $product->test();
        // }
    //     // exit;
    //    dd($popular_products[0]->images);
        
        // $this->view->params['categories'] = Category::buildTree();
        // $this->view->params['sub_categories'] = $sub_categories;
        
        return $this->render('index', [
            'popular_products' => $popular_products,
            'articles' => $articles,
        ]);

        // return $this->render('index', [
        //     'categories' => $categories,
        //     'sub_categories' => $sub_categories,
        // ]);
    }

    public function actionSearch()
    {
        $searchTerm = Yii::$app->request->post('search'); // Получаем данные из формы

        if (!empty($searchTerm)) {
            // Выполняем поиск в таблице products
            $results = Product::find()
                ->where(['like', 'name', $searchTerm]) // LIKE по полю title
                ->all();
            dd($results);
            // Передаём результаты в вид
            return $this->render('search-results', [
                'results' => $results,
                'searchTerm' => $searchTerm,
            ]);
        }
    }

}
