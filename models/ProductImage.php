<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_images".
 *
 * @property int $id
 * @property int $prod_id
 * @property string $image
 */
class ProductImage extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prod_id', 'image'], 'required'],
            [['prod_id'], 'integer'],
            [['image'], 'string', 'max' => 100],
            [['imageFile'], 'file', 'extensions' => 'jpeg, jpg, png', 'mimeTypes' => 'image/jpeg, image/png', 'maxSize' => 2 * 1024 * 1024], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prod_id' => 'Prod ID',
            'image' => 'Image',
        ];
    }
}
