<?php

use yii\db\Migration;

/**
 * Class m201010_064453_create_table_tbl_post
 */
class m201010_064453_create_table_tbl_post extends Migration
{
    /**
     * {@inheritdoc}
     */
//    public function safeUp()
//    {
//
//    }

    /**
     * {@inheritdoc}
     */
//    public function safeDown()
//    {
//        echo "m201010_064453_create_table_tbl_post cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('tbl_post', [
            'id' => $this->primaryKey()->unsigned(),
            'title' => $this->string(45)->notNull(),
            'slug' => $this->string(50)->notNull(),
            'body' => $this->string(800)->notNull(),
            'img_loc1' => $this->string(80),
            'img_loc2' => $this->string(80),
            'user_id' => $this->integer(11)->notNull(),
            'category_id' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex('idx_post_user_id_user', 'tbl_post', 'user_id');
        $this->addForeignKey('fk_post_user_id_user', 'tbl_post', 'user_id', 'tbl_user', 'id', 'restrict', 'cascade');

        $this->createIndex('idx_post_category_id_category', 'tbl_post', 'category_id');
        $this->addForeignKey('fk_post_category_id_category', 'tbl_post', 'category_id', 'tbl_category', 'id', 'restrict', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('fk_post_user_id_user', 'tbl_post');
        $this->dropIndex('idx_post_user_id_user', 'tbl_post');

        $this->dropForeignKey('fk_post_category_id_category', 'tbl_post');
        $this->dropIndex('idx_post_category_id_category', 'tbl_post');

        $this->dropTable('tbl_post');
    }

}
