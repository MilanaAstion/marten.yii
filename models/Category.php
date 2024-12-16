<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property string|null $img
 * @property int $parent_id
 */
class Category extends \yii\db\ActiveRecord
{
    public $children;
    const MAIN_PARENT_ID = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['img'], 'string', 'max' => 100],
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
            'img' => 'Img',
            'parent_id' => 'Parent ID',
        ];
    }

    public static function buildTree()
    {
        $categories = self::find()->where(['parent_id' => 0])->all();
        // $sub_categories = Category::find()->where(['!=', 'parent_id', 0])->all();
        foreach($categories as $category){
            $category->children =  self::find()->where(['parent_id' => $category->id])->all();
        }
        return $categories;
    }

    public function getParent()
    {
        return self::findOne($this->parent_id);
    }
}
