<?php

use yii\db\Migration;

/**
 * Handles the creation of table `site_brand`.
 * Has foreign keys to the tables:
 *
 * - `siteId`
 */
class m170520_171342_create_site_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('site_brand', [
            'id' => $this->primaryKey(),
            'logoAltText' => $this->string()->defaultValue('your logo'),
            'headerText' => $this->string()->defaultValue('Header text'),
            'headerTextColor' => $this->string()->defaultValue('#ccc'),
            'headerColor' => $this->string()->defaultValue('#ccc'),
            'navButtonColor' => $this->string()->defaultValue('#ccc'),
            'logoFile' => $this->string(),
            'siteId' => $this->integer(),
        ]);

        // creates index for column `siteId`
        $this->createIndex(
            'idx-site_brand-siteId',
            'site_brand',
            'siteId'
        );

        // add foreign key for table `siteId`
        $this->addForeignKey(
            'fk-site_brand-siteId',
            'site_brand',
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
        // drops foreign key for table `siteId`
        $this->dropForeignKey(
            'fk-site_brand-siteId',
            'site_brand'
        );

        // drops index for column `siteId`
        $this->dropIndex(
            'idx-site_brand-siteId',
            'site_brand'
        );

        $this->dropTable('site_brand');
    }
}
