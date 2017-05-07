<?php

use yii\db\Migration;

/**
 * Handles the creation of table `site`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170507_073244_create_site_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('site', [
            'id' => $this->primaryKey(),
            'subDomain' => $this->string(),
            'user_id' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->notNull(),
            'state' => $this->integer(1),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-site-user_id',
            'site',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-site-user_id',
            'site',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-site-user_id',
            'site'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-site-user_id',
            'site'
        );

        $this->dropTable('site');
    }
}
