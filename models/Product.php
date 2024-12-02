<?php

namespace app\models;

use Yii;
use app\models\Category;
/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int|null $old_price
 * @property int $cat_id
 * @property string $descr
 * @property int|null $popular
 */
class Product extends \yii\db\ActiveRecord
{
    const POPULAR_ID = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'cat_id', 'descr'], 'required'],
            [['price', 'old_price', 'cat_id', 'popular'], 'integer'],
            [['descr'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'old_price' => 'Old Price',
            'cat_id' => 'Category',
            'descr' => 'Descr',
            'popular' => 'Popular',
        ];
    }

    public function getImages()
    {
        // return ProductImage::find()->where(['prod_id' => $this->id])->all();
        return $this->hasMany(ProductImage::class, ['prod_id' => 'id']);
    }

    public function getCategory()
    {
        // return Category::findOne($this->cat_id);
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }
}
