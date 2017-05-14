<?php

use yii\db\Migration;

/**
 * Handles adding name to table `ideaUser`.
 */
class m170513_061629_add_name_column_to_ideaUser_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('ideaUser', 'name', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('ideaUser', 'name');
    }
}
