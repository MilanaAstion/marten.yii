<?php

use yii\db\Migration;

/**
 * Class m241115_091851_create_table_articles
 */
class m241115_091851_create_table_articles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('articles', [ 
            'id' => $this->primaryKey(), 
            'title' => $this->string()->notNull(), 
            'img' => $this->string(100)->notNull(),
            'author' => $this->string(100)->notNull(),
            'created' => $this->string(100)->notNull(),
            'content' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articles');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241115_091851_create_table_articles cannot be reverted.\n";

        return false;
    }
    */
}
