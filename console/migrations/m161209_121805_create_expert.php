<?php

use yii\db\Migration;

class m161209_121805_create_expert extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('expert', [
            'id' => $this->primaryKey(),
            'title' => $this->string('500')->notNull(),
            'description' => $this->string('500')->notNull(),
            'email' => $this->string('20')->notNull(),
            'phone' => $this->string('20')->notNull(),
            'text' => $this->text(),
            'image' =>$this->string('200')->notNull(),
            'expertise_areas' =>$this->string('1000')->notNull(),
            'current_positions' =>$this->string('1000')->notNull(),
            'past_positions' =>$this->string('1000')->notNull(),
            'education' =>$this->string('1000')->notNull(),
            'cv' =>$this->string('100')->notNull(),
        ],$tableOptions);
    }

    public function down()
    {
        echo "m161209_121805_create_expert cannot be reverted.\n";

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
