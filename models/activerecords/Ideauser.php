<?php

namespace app\models\activerecords;

use Yii;

/**
 * This is the model class for table "ideaUser".
 *
 * @property integer $id
 * @property string $email
 * @property integer $authType
 * @property string $authUserId
 * @property string $createdAt
 * @property string $name
 */
class IdeaUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ideauser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['authType', 'authUserId'], 'integer'],
            [['createdAt'], 'safe'],
            [['email', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'authType' => Yii::t('app', 'Auth Type'),
            'authUserId' => Yii::t('app', 'Auth User ID'),
            'createdAt' => Yii::t('app', 'Created At'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
