<?php
namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class ArticleImageForm extends Model
{
    public $image;
    public $fileName;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpeg, jpg, png', 'mimeTypes' => 'image/jpeg, image/png', 'maxSize' => 2 * 1024 * 1024],
        ];
    }

    public function upload()
    {
        $this->image = UploadedFile::getInstance($this, 'image');
        // dd($this->imageFile);
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
        $filePath = Yii::getAlias('@webroot') . '/img/blog/' . $this->fileName;
        // Сохраняем файл
        $this->image->saveAs($filePath);
    }

    private function generateFileName()
    {
        $this->fileName = uniqid() . '.' . $this->image->extension; // Например, "64b9fc2d.jpg"
    }
}