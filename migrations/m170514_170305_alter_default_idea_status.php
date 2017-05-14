<?php

use yii\db\Migration;

class m170514_170305_alter_default_idea_status extends Migration
{
    public function up()
    {
        $this->alterColumn('idea', 'status', 'int not null default 1');
    }

    public function down()
    {
        

        return true;
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
