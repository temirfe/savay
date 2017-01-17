<?php

use yii\db\Migration;

class m170117_123156_addcol_views_article extends Migration
{
    public function up()
    {
        $this->addColumn('article','views','integer NOT NULL');
    }

    public function down()
    {
        echo "m170117_123156_addcol_views_article cannot be reverted.\n";

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
