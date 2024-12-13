<?php

namespace app\controllers;
use Yii;
use app\models\ProductImage;
use app\models\ProductImageForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Product;
use yii\web\UploadedFile;

/**
 * ProductImageController implements the CRUD actions for productImage model.
 */
class ProductImageController extends Controller
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
     * Lists all productImage models.
     *
     * @return string
     */
    public function actionIndex($prod_id)
    {
        $product = Product::findOne($prod_id);
        $dataProvider = new ActiveDataProvider([
            'query' => ProductImage::find()->where(['prod_id' => $prod_id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'product' => $product,
        ]);
    }

    /**
     * Creates a new productImage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($prod_id)
    {
        $model = new ProductImage();
        $img = new ProductImageForm();

        if ($this->request->isPost) {
            // dd($prod_id);
            if ($model->load($this->request->post())) {
                $model->image = $img->upload();
                // Сохраняем модель
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Изображение успешно загружено.');
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка сохранения данных.');
                }               

            return $this->redirect(['index', 'prod_id' =>  $prod_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'prod_id' => $prod_id,
            'img' => $img,
        ]);
    }


    /**
     * Deletes an existing productImage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $image = $this->findModel($id);
        
        $this->deleteFiles($image->image);

        $this->findModel($id)->delete();

        return $this->redirect(['index', "prod_id" => $image->prod_id]);
    }

    public function deleteFiles($image)
    {
        $folders = ["big", "card", "min", "original"];

        foreach($folders as $folder){
            if (file_exists(Yii::getAlias('@webroot/img/product/'. $folder . "/" . $image))) {
                unlink(Yii::getAlias('@webroot/img/product/'. $folder . "/" . $image));
            }
        }
    }
    /**
     * Finds the productImage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return productImage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = productImage::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
