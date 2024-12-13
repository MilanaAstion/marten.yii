<?php
namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use Intervention\Image\ImageManagerStatic as Image;

class ProductImageForm extends Model
{
    public $imageFile;
    public $fileName;

    public function rules()
    {
        return [
            [['imageFile'], 'required'],
            [['imageFile'], 'file', 'extensions' => 'jpeg, jpg, png', 'mimeTypes' => 'image/jpeg, image/png', 'maxSize' => 2 * 1024 * 1024],
        ];
    }

    public function upload()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        // dd($this->imageFile);
        if ($this->validate()) {
            $this->moveFile();
            $this->dublicateImage();
            return $this->fileName;
        } else {
            return false;
        }
    }

    public function moveFile()
    {
        $this->generateFileName();
        $filePath = Yii::getAlias('@webroot') . '/img/product/original/' . $this->fileName;
        // Сохраняем файл
        $this->imageFile->saveAs($filePath);
    }

    private function generateFileName()
    {
        // $this->fileName = time() . '.' . $this->imageFile->extension;
        $this->fileName = uniqid() . '.' . $this->imageFile->extension; // Например, "64b9fc2d.jpg"
    }

    private function dublicateImage()
    {
        $filePath = Yii::getAlias('@webroot') . '/img/product/original/' . $this->fileName;
        // Загружаем изображение
        $image = Image::make($filePath);
        // Изменяем размер
        $image->resize(600, 650);
        // Сохраняем
        $image->save(Yii::getAlias('@webroot') . '/img/product/big/' . $this->fileName);
        $image->resize(270, 265);
        $image->save(Yii::getAlias('@webroot') . '/img/product/card/' . $this->fileName);
        $image->resize(140, 135);
        $image->save(Yii::getAlias('@webroot') . '/img/product/min/' . $this->fileName);
    }
}