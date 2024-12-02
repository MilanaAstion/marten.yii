<?php

use yii\db\Migration;

/**
 * Class m241105_100358_create_table_categories
 */
class m241105_100358_create_table_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories', [ 
            'id' => $this->primaryKey(), 
            'name' => $this->string()->notNull(), 
            'img' => $this->string(100),
            'parent_id' => $this->integer()->notNull()->defaultValue(0), 
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categories');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241105_100358_create_table_categories cannot be reverted.\n";

        return false;
    }
    */
}
