<?php

namespace app\models\activerecords;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $createAt
 * @property integer $active
 * @property string $activationKey
 *
 * @property Site[] $sites
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'active'], 'required'],
            [['createAt'], 'safe'],
            [['active'], 'integer'],
            [['activationKey'], 'string'],
            [['name', 'email', 'password'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'createAt' => Yii::t('app', 'Create At'),
            'active' => Yii::t('app', 'Active'),
            'activationKey' => Yii::t('app', 'Activation Key'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSites()
    {
        return $this->hasMany(Site::className(), ['user_id' => 'id']);
    }
}
