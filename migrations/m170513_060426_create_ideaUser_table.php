<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ideaUser`.
 */
class m170513_060426_create_ideaUser_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ideaUser', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull(),
            'authType' => $this->smallInteger(),
            'authUserId' => $this->bigInteger(),
            'createdAt' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('ideaUser');
    }
}
