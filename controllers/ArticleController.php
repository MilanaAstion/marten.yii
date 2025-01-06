<?php

namespace app\controllers;

use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use app\models\ArticleImageForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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
     * Lists all Article models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

        $model = new Article();

        $articleImage = new ArticleImageForm();

        if ($this->request->isPost) {
            // Загружаем данные из POST-запроса
            if ($model->load($this->request->post())) {
                // Сохраняем путь к файлу в модель
                $model->img = $articleImage->upload();
                $model->created = strval(time());
                
                // Сохраняем модель
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Статья успешно создана.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка сохранения данных.');
                }
            }
        } 
    
        return $this->render('create', [
            'model' => $model,
            'articleImage' => $articleImage,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUploadImage()
    {
        // $imageFile = UploadedFile::getInstanceByName('upload');
        // $fileName = uniqid() . '.' . $imageFile->extension;
        // $filePath = Yii::getAlias('@webroot') . '/img/blog/' . $fileName;
        // $imageFile->saveAs($filePath);
        // return '/img/blog/' . $fileName;
        if (isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['upload']['tmp_name'];  // Временный путь
            $ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid() . '.' . $ext;
            $filePath = Yii::getAlias('@webroot') . '/img/blog/' . $fileName;
        
            // Перемещение файла из временной директории в указанную
            if (move_uploaded_file($fileTmpPath, $filePath)) {
                return '/img/blog/' . $fileName;
            } else {
                return "Ошибка при сохранении файла.";
            }
        } else {
            return "Файл не был загружен или произошла ошибка.";
        }
    }
}
