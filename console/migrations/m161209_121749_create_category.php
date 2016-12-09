<?php

use yii\db\Migration;

class m161209_121749_create_category extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'url' => $this->string('20')->notNull(),
            'title' => $this->string('250')->notNull(),
            'description' => $this->string('500')->notNull(),
        ],$tableOptions);
    }

    public function down()
    {
        echo "m161209_121749_create_category cannot be reverted.\n";

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
