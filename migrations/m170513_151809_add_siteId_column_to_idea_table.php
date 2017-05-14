<?php

use yii\db\Migration;

/**
 * Handles adding siteId to table `idea`.
 * Has foreign keys to the tables:
 *
 * - `site`
 */
class m170513_151809_add_siteId_column_to_idea_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('idea', 'siteId', $this->integer());

        // creates index for column `siteId`
        $this->createIndex(
            'idx-idea-siteId',
            'idea',
            'siteId'
        );

        // add foreign key for table `site`
        $this->addForeignKey(
            'fk-idea-siteId',
            'idea',
            'siteId',
            'site',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `site`
        $this->dropForeignKey(
            'fk-idea-siteId',
            'idea'
        );

        // drops index for column `siteId`
        $this->dropIndex(
            'idx-idea-siteId',
            'idea'
        );

        $this->dropColumn('idea', 'siteId');
    }
}
