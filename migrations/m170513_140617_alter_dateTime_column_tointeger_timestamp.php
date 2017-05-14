<?php

use yii\db\Migration;

class m170513_140617_alter_dateTime_column_tointeger_timestamp extends Migration
{
    public function up()
    {
        $this->alterColumn('user', 'createAt', 'integer');
        $this->alterColumn('site', 'createdAt', 'integer');
        $this->alterColumn('ideaUser', 'createdAt', 'integer');
        $this->alterColumn('idea', 'createdAt', 'integer');
        $this->alterColumn('idea', 'status', 'integer(1) not null default 0');
        $this->alterColumn('idea', 'votes', 'integer(1) not null default 0');
        $this->alterColumn('idea', 'like', 'integer(1) not null default 0');
    }

    public function down()
    {
        $this->alterColumn('user', 'createAt', 'dateTime');
        $this->alterColumn('site', 'createdAt', 'dateTime');
        $this->alterColumn('ideaUser', 'createdAt', 'dateTime');
        $this->alterColumn('idea', 'createdAt', 'dateTime');
        
        
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
