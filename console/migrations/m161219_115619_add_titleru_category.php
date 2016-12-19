<?php

use yii\db\Migration;

class m161219_115619_add_titleru_category extends Migration
{
    public function up()
    {
        $this->addColumn('category','title_en','varchar(255) NULL');
    }

    public function down()
    {
        echo "m161219_115619_add_titleru_category cannot be reverted.\n";

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
