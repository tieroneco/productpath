<?php

namespace app\models\activerecords;

use Yii;

/**
 * This is the model class for table "site".
 *
 * @property integer $id
 * @property string $subDomain
 * @property integer $user_id
 * @property string $createdAt
 * @property integer $state
 *
 * @property Idea[] $ideas
 * @property User $user
 */
class Site extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'createdAt'], 'required'],
            [['user_id', 'state'], 'integer'],
            [['createdAt'], 'safe'],
            [['subDomain'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subDomain' => Yii::t('app', 'Sub Domain'),
            'user_id' => Yii::t('app', 'User ID'),
            'createdAt' => Yii::t('app', 'Created At'),
            'state' => Yii::t('app', 'State'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdeas()
    {
        return $this->hasMany(Idea::className(), ['site_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
