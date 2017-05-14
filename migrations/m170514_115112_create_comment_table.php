<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 * Has foreign keys to the tables:
 *
 * - `idea`
 * - `ideauser`
 */
class m170514_115112_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'commentText' => $this->string()->notNull(),
            'createdAt'=>$this->integer(),
            'ideaId' => $this->integer(),
            'commentUserId' => $this->integer(),
        ]);

        // creates index for column `ideaId`
        $this->createIndex(
            'idx-comment-ideaId',
            'comment',
            'ideaId'
        );

        // add foreign key for table `idea`
        $this->addForeignKey(
            'fk-comment-ideaId',
            'comment',
            'ideaId',
            'idea',
            'id',
            'CASCADE'
        );

        // creates index for column `commentUserId`
        $this->createIndex(
            'idx-comment-commentUserId',
            'comment',
            'commentUserId'
        );

        // add foreign key for table `ideauser`
        $this->addForeignKey(
            'fk-comment-commentUserId',
            'comment',
            'commentUserId',
            'ideauser',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `idea`
        $this->dropForeignKey(
            'fk-comment-ideaId',
            'comment'
        );

        // drops index for column `ideaId`
        $this->dropIndex(
            'idx-comment-ideaId',
            'comment'
        );

        // drops foreign key for table `ideauser`
        $this->dropForeignKey(
            'fk-comment-commentUserId',
            'comment'
        );

        // drops index for column `commentUserId`
        $this->dropIndex(
            'idx-comment-commentUserId',
            'comment'
        );

        $this->dropTable('comment');
    }
}
