<?php

use yii\db\Migration;

/**
 * Class m201010_064446_create_table_tbl_category
 */
class m201010_064446_create_table_tbl_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_category', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(45)->notNUll()
        ]);

        $this->batchInsert('tbl_category', ['id','name'], [
            ['1', 'Art'],
            ['2', 'Fashion'],
            ['3', 'Financial'],
            ['4', 'Information'],
            ['5', 'Lifestyle'],
            ['6', 'Music'],
            ['7', 'Science and Technology'],
            ['8', 'Technologies']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Delete table data
        $this->delete('tbl_category');
        // Delete table
        $this->dropTable('tbl_category');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201010_064446_create_table_tbl_category cannot be reverted.\n";

        return false;
    }
    */
}
