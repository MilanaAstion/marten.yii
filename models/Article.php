<?php

namespace app\models;
use app\models\ArticleComment;
use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $img
 * @property string $author
 * @property string $created
 * @property string $content
 */
class Article extends \yii\db\ActiveRecord
{

    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'img', 'author', 'created', 'content'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['img', 'author', 'created'], 'string', 'max' => 100],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 2], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'img' => 'Img',
            'author' => 'Author',
            'created' => 'Created',
            'content' => 'Content',
        ];
    }

    public function getComments()
    {
        return $this->hasMany(ArticleComment::class, ['article_id' => 'id']);
    }
}
