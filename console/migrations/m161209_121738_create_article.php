<?php

use yii\db\Migration;

class m161209_121738_create_article extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string('500')->notNull(),
            'text' => $this->text(),
            'image' =>$this->string('200')->notNull(),
            'category_id' => $this->smallInteger('6')->notNull()->defaultValue(0),
            'expert_id' => $this->smallInteger('6')->notNull()->defaultValue(0),
            'date_create'=>$this->timestamp(),
            'footnotes' =>$this->string('1000')->notNull(),
        ],$tableOptions);

        $this->createIndex('idx_page_expert', 'article', 'expert_id');
        $this->createIndex('idx_article_category', 'article', 'category_id');
    }

    public function down()
    {
        echo "m161209_121738_create_article cannot be reverted.\n";

        return false;
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
