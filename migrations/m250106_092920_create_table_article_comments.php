<?php

use yii\db\Migration;

/**
 * Class m250106_092920_create_table_article_comments
 */
class m250106_092920_create_table_article_comments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_comments', [ 
            'id' => $this->primaryKey(), 
            'article_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(), 
            'email' => $this->string(100)->notNull(),
            'message' => $this->text()->notNull(),
            'img' => $this->string(100)->notNull(),
            'created' => $this->string(100)->notNull(),
        ]);

        // Заполняем таблицу данными
        $this->batchInsert('article_comments', 
            ['article_id', 'name', 'email', 'message', 'img', 'created'], 
            [
                ['1', 'John Doe', 'john@example.com', 'This is a message.', 'john.jpg', '2025-01-06 12:00:00'],
                ['1', 'Jane Smith', 'jane@example.com', 'Another message.', 'jane.jpg', '2025-01-06 12:05:00'],
                ['1', 'Alice Brown', 'alice@example.com', 'Yet another comment.', 'alice.jpg', '2025-01-06 12:10:00'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_comments');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250106_092920_create_table_article_comments cannot be reverted.\n";

        return false;
    }
    */
}
