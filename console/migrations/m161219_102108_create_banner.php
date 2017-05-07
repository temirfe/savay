<?php

use yii\db\Migration;

class m161219_102108_create_banner extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('banner', [
            'id' => $this->primaryKey(),
            'image' => $this->string(100)->notNull(),
            'title_ru' => $this->string(250)->notNull(),
            'title_en' => $this->string(250)->notNull(),
            'title_ky' => $this->string(250)->notNull(),
            'title_tr' => $this->string(250)->notNull(),
            'url' => $this->string(100)->notNull(),
        ],$tableOptions);
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
