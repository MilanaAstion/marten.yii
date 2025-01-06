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

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250106_092920_create_table_article_comments cannot be reverted.\n";

        return false;
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
