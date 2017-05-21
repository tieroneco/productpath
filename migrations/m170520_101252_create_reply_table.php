<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reply`.
 * Has foreign keys to the tables:
 *
 * - `idea`
 */
class m170520_101252_create_reply_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('reply', [
            'id' => $this->primaryKey(),
            'ideaId' => $this->integer(),
            'reply' => $this->text(),
        ]);

        // creates index for column `ideaId`
        $this->createIndex(
            'idx-reply-ideaId',
            'reply',
            'ideaId'
        );

        // add foreign key for table `idea`
        $this->addForeignKey(
            'fk-reply-ideaId',
            'reply',
            'ideaId',
            'idea',
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
            'fk-reply-ideaId',
            'reply'
        );

        // drops index for column `ideaId`
        $this->dropIndex(
            'idx-reply-ideaId',
            'reply'
        );

        $this->dropTable('reply');
    }
}
