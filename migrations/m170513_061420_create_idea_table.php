<?php

use yii\db\Migration;

/**
 * Handles the creation of table `idea`.
 * Has foreign keys to the tables:
 *
 * - `ideaUser`
 */
class m170513_061420_create_idea_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('idea', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'body' => $this->text()->notNull(),
            'createdAt' => $this->dateTime(),
            'ideaUserId' => $this->integer()->notNull(),
        ]);

        // creates index for column `ideaUserId`
        $this->createIndex(
            'idx-idea-ideaUserId',
            'idea',
            'ideaUserId'
        );

        // add foreign key for table `ideaUser`
        $this->addForeignKey(
            'fk-idea-ideaUserId',
            'idea',
            'ideaUserId',
            'ideaUser',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `ideaUser`
        $this->dropForeignKey(
            'fk-idea-ideaUserId',
            'idea'
        );

        // drops index for column `ideaUserId`
        $this->dropIndex(
            'idx-idea-ideaUserId',
            'idea'
        );

        $this->dropTable('idea');
    }
}
