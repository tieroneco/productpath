<?php

use yii\db\Migration;

class m170604_071808_create_junction_table_for_idea_and_ip extends Migration
{
    public function up()
    {
        $this->createTable('idea_ip', [
            'idea_id'=>'int NOT NULL ',
            'ip' => 'varchar(15) not null'
        ]);
        $this->createIndex(
            'idx-idea_ip-idea_id',
            'idea_ip',
            'idea_id'
        );
        $this->addForeignKey(
            'fk-idea_ip-idea_id',
            'idea_ip',
            'idea_id',
            'idea',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m170604_071808_create_junction_table_for_idea_and_ip cannot be reverted.\n";

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
