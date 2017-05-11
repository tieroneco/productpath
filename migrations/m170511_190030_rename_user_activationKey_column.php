<?php

use yii\db\Migration;

class m170511_190030_rename_user_activationKey_column extends Migration
{
    public function up()
    {
        $this->renameColumn('user', 'activattionKey', 'activationKey');
    }

    public function down()
    {
        echo "m170511_190030_rename_user_activationKey_column cannot be reverted.\n";

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
