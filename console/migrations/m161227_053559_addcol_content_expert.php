<?php

use yii\db\Migration;

class m161227_053559_addcol_content_expert extends Migration
{
    public function up()
    {
        $this->addColumn('expert','content','text');
    }

    public function down()
    {
        echo "m161227_053559_addcol_content_expert cannot be reverted.\n";

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
