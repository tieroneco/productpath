<?php

namespace app\models\activerecords;

use Yii;

/**
 * This is the model class for table "site_brand".
 *
 * @property integer $id
 * @property string $logoAltText
 * @property string $headerText
 * @property string $headerTextColor
 * @property string $headerColor
 * @property string $navButtonColor
 * @property string $logoFile
 * @property integer $siteId
 *
 * @property Site $site
 */
class SiteBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['siteId'], 'integer'],
            [['logoAltText', 'headerText', 'headerTextColor', 'headerColor', 'navButtonColor', 'logoFile'], 'string', 'max' => 255],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'logoAltText' => Yii::t('app', 'Logo Alt Text'),
            'headerText' => Yii::t('app', 'Header Text'),
            'headerTextColor' => Yii::t('app', 'Header Text Color'),
            'headerColor' => Yii::t('app', 'Header Color'),
            'navButtonColor' => Yii::t('app', 'Nav Button Color'),
            'logoFile' => Yii::t('app', 'Logo File'),
            'siteId' => Yii::t('app', 'Site ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }
}
