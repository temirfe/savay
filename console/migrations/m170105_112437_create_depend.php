<?php

use yii\db\Migration;

class m170105_112437_create_depend extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('depend', [
            'table_name' => $this->string('20')->notNull(),
            'last_update' => $this->string('20')->notNull(),
        ],$tableOptions);

        $this->insert('depend',array(
            'table_name'=>'article',
            'last_update' =>time(),
        ));
        $this->insert('depend',array(
            'table_name'=>'event',
            'last_update' =>time(),
        ));
    }

    public function down()
    {
        echo "m170105_112437_create_depend cannot be reverted.\n";

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
