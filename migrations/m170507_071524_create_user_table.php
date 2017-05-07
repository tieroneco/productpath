<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170507_071524_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),            
            'createAt' => $this->dateTime()." default CURRENT_TIMESTAMP",
            'active'=>$this->integer(1)->notNull(),
            'activattionKey'=>$this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
