<?php

use yii\db\Migration;

class m161216_082422_create_participant extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('participant', [
            'id' => $this->primaryKey(),
            'expert_id' => $this->smallInteger('6')->notNull()->defaultValue(0),
            'model_name' => $this->string('20')->notNull(),
            'model_id' => $this->integer()->notNull(),
        ],$tableOptions);

        $this->createIndex('idx_part_mod', 'participant', 'model_id');
        $this->createIndex('idx_part_exp', 'participant', 'expert_id');
    }

    public function down()
    {
        echo "m161216_082422_create_participant cannot be reverted.\n";

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
