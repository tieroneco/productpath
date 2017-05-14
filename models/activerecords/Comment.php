<?php

namespace app\models\activerecords;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $commentText
 * @property integer $createdAt
 * @property integer $ideaId
 * @property integer $commentUserId
 *
 * @property Ideauser $commentUser
 * @property Idea $idea
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commentText'], 'required'],
            [['createdAt', 'ideaId', 'commentUserId'], 'integer'],
            [['commentText'], 'string', 'max' => 255],
            [['commentUserId'], 'exist', 'skipOnError' => true, 'targetClass' => Ideauser::className(), 'targetAttribute' => ['commentUserId' => 'id']],
            [['ideaId'], 'exist', 'skipOnError' => true, 'targetClass' => Idea::className(), 'targetAttribute' => ['ideaId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'commentText' => Yii::t('app', 'Comment Text'),
            'createdAt' => Yii::t('app', 'Created At'),
            'ideaId' => Yii::t('app', 'Idea ID'),
            'commentUserId' => Yii::t('app', 'Comment User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentUser()
    {
        return $this->hasOne(Ideauser::className(), ['id' => 'commentUserId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdea()
    {
        return $this->hasOne(Idea::className(), ['id' => 'ideaId']);
    }
}
