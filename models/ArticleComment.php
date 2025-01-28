<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_comments".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property string $img
 * @property string $created
 */
class ArticleComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message', 'img', 'created', 'article_id'], 'required'],
            [['message'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['email', 'img'], 'string', 'max' => 100],
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
            'email' => 'Email',
            'message' => 'Message',
            'img' => 'Img',
            'created' => 'Created',
        ];
    }

    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}
