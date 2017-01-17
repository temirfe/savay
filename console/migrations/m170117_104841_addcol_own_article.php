<?php

use yii\db\Migration;

class m170117_104841_addcol_own_article extends Migration
{
    public function up()
    {
        $this->addColumn('article','own','boolean NOT NULL');
    }

    public function down()
    {
        echo "m170117_104841_addcol_own_article cannot be reverted.\n";

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
