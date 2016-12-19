<?php

use yii\db\Migration;

class m161219_102108_create_banner extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('banner', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'model_name' => $this->string(30)->notNull(),
        ],$tableOptions);
        $this->createIndex('idx_banner_model', 'banner', 'model_id');
    }

    public function down()
    {
        echo "m161219_102108_create_banner cannot be reverted.\n";

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
