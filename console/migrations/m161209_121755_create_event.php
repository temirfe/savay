<?php

use yii\db\Migration;

class m161209_121755_create_event extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'title' => $this->string('500')->notNull(),
            'description' => $this->string('500')->notNull(),
            'text' => $this->text(),
            'image' =>$this->string('200')->notNull(),
            'date_start'=>$this->dateTime(),
            'date_end'=>$this->dateTime(),
            'place' =>$this->string('500')->notNull(),
            'latlong' =>$this->string('250')->notNull(),
            'hosted_by' =>$this->string('255')->notNull(),
        ],$tableOptions);
    }

    public function down()
    {
        echo "m161209_121755_create_event cannot be reverted.\n";

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
