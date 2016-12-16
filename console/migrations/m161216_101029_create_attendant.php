<?php

use yii\db\Migration;

class m161216_101029_create_attendant extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('attendant', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'fullname' => $this->string('100')->notNull(),
            'email' => $this->string('100')->notNull(),
            'phone' => $this->string('100')->notNull(),
            'organization' => $this->string('100')->notNull(),
            'job_title' => $this->string('100')->notNull(),
            'date_create'=>$this->timestamp(),
        ],$tableOptions);
        $this->createIndex('idx_attendant_eve', 'attendant', 'event_id');
    }

    public function down()
    {
        echo "m161216_101029_create_attendant cannot be reverted.\n";

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
