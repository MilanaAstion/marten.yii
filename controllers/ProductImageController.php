<?php

namespace app\controllers;
use Yii;
use app\models\ProductImage;
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

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Получение экземпляра загруженного файла
                $uploadedFile = UploadedFile::getInstance($model, 'imageFile');
                
                if ($uploadedFile) {
                    // Создаём уникальное имя файла
                    $uniqueFileName = uniqid() . '.' . $uploadedFile->extension; // Например, "64b9fc2d.jpg"
            
                    // Путь к папке сохранения
                    $folder = 'img/product/' . $folder; // Например, "img/product/2024"
                    $filePath = Yii::getAlias('@webroot') . '/' . $folder . '/' . $uniqueFileName;
            
                    // Создаём папку, если её нет
                    if (!is_dir(Yii::getAlias('@webroot') . '/' . $folder)) {
                        mkdir(Yii::getAlias('@webroot') . '/' . $folder, 0777, true);
                    }
            
                    // Сохраняем файл
                    if ($uploadedFile->saveAs($filePath)) {
                        // Сохраняем уникальное имя файла в модели
                        $model->image = $folder . '/' . $uniqueFileName; // Сохраните путь в БД
                    }
                }
            
                // Сохраняем модель
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Изображение успешно загружено.');
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка сохранения данных.');
                }               

            return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'prod_id' => $prod_id,
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
        $image = $this->findModel($id)->image;
        
        $this->deleteFiles($image);

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
