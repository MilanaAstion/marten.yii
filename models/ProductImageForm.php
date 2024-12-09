<?php
namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;

class ProductImageForm extends Model
{
    public $imageFile;
    public $fileName;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'extensions' => 'jpeg, jpg, png', 'mimeTypes' => 'image/jpeg, image/png', 'maxSize' => 2 * 1024 * 1024],
        ];
    }

    public function upload()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if ($this->validate()) {
            $this->moveFile();
            return $this->fileName;
        } else {
            return false;
        }
    }

    public function moveFile()
    {
        $this->generateFileName();
        // $this->imageFile->saveAs('@webroot/img/' . $this->fileName);
        $folder = 'min';
        // Путь к папке сохранения
        $folder = 'img/product/' . $folder; // Например, "img/product/2024"
        $filePath = Yii::getAlias('@webroot') . '/' . $folder . '/' . $uniqueFileName;
        // Сохраняем файл
        if ($uploadedFile->saveAs($filePath)) {
            // Сохраняем уникальное имя файла в модели
            $model->image = $uniqueFileName; // Сохраните путь в БД
        }
    }

    private function generateFileName()
    {
        // $this->fileName = time() . '.' . $this->imageFile->extension;
        $this->fileName = uniqid() . '.' . $this->imageFile->extension; // Например, "64b9fc2d.jpg"
    }
}