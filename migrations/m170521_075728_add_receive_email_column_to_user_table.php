<?php

use yii\db\Migration;

/**
 * Handles adding receive_email to table `user`.
 */
class m170521_075728_add_receive_email_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'receive_email', $this->integer(1)->defaultValue(1));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'receive_email');
    }
}
