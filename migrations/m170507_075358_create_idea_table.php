<?php

use yii\db\Migration;

/**
 * Handles the creation of table `idea`.
 * Has foreign keys to the tables:
 *
 * - `site`
 */
class m170507_075358_create_idea_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('idea', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'site_id' => $this->integer()->notNull(),
            'status' => $this->integer(1)->defaultValue(1),
            'likes' => $this->integer()->defaultValue(0),
            'votes' => $this->integer()->defaultValue(0),
            'createdAt' => $this->dateTime()->notNull(),
            'posterEmail' => $this->string()->notNull(),
            'posterName' => $this->string(),
        ]);

        // creates index for column `site_id`
        $this->createIndex(
            'idx-idea-site_id',
            'idea',
            'site_id'
        );

        // add foreign key for table `site`
        $this->addForeignKey(
            'fk-idea-site_id',
            'idea',
            'site_id',
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
            'fk-idea-site_id',
            'idea'
        );

        // drops index for column `site_id`
        $this->dropIndex(
            'idx-idea-site_id',
            'idea'
        );

        $this->dropTable('idea');
    }
}
