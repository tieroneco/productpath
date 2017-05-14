<?php

use yii\db\Migration;

/**
 * Handles adding some to table `idea`.
 */
class m170513_062146_add_some_column_to_idea_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('idea', 'status', $this->smallInteger(1));
        $this->addColumn('idea', 'votes', $this->integer());
        $this->addColumn('idea', 'like', $this->integer());
        $this->addColumn('idea', 'receieveEmail', $this->smallInteger(1));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('idea', 'status');
        $this->dropColumn('idea', 'votes');
        $this->dropColumn('idea', 'like');
        $this->dropColumn('idea', 'receieveEmail');
    }
}
