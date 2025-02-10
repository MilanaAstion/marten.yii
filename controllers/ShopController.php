<?php

namespace app\controllers;
use app\models\Product;
use app\models\Category;
use yii\data\Pagination;

class ShopController extends \yii\web\Controller
{
    public $layout = 'public';

    public function beforeAction($action)
    {
        $this->view->params['categories'] = Category::buildTree();
        
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $name_page = "Shop Page";

        $query = Product::find();

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize'   => 2,  
        ]);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', ["name_page" => $name_page, "products" => $products, "pages" => $pages]);
    }

    public function actionCategory($cat_id)
    {
        dd($cat_id);
        return $this->render('category');
    }

    public function actionProduct()
    {
        return $this->render('product');
    }

}
