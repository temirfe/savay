<?php

use yii\db\Migration;

class m161120_065441_create_page extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'url' => $this->string('20')->notNull(),
            'title' => $this->string('500')->notNull(),
            'text' => $this->text(),
            'image' =>$this->string('200')->notNull(),
            'lang' =>$this->string('5')->notNull(),
            'description' =>$this->string('1000')->notNull(),
            'fact' =>$this->string('255')->notNull(),
            'category' => $this->integer('6')->notNull()->defaultValue(0),
        ],$tableOptions);

        $this->createIndex('idx_page_url', 'page', 'url');
        $this->createIndex('idx_page_category', 'page', 'category');
    }

    public function down()
    {
        $this->dropTable('page');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
