<?php

namespace app\models\activerecords;

use Yii;

/**
 * This is the model class for table "idea".
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $createdAt
 * @property integer $ideaUserId
 * @property integer $status
 * @property integer $votes
 * @property integer $like
 * @property integer $receieveEmail
 * @property integer $siteId
 *
 * @property Comment[] $comments
 * @property Ideauser $ideaUser
 * @property Site $site
 * @property IdeaIp[] $ideaIps
 * @property Reply[] $replies
 */
class Idea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'idea';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body', 'ideaUserId'], 'required'],
            [['body'], 'string'],
            [['createdAt', 'ideaUserId', 'status', 'votes', 'like', 'receieveEmail', 'siteId'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['ideaUserId'], 'exist', 'skipOnError' => true, 'targetClass' => Ideauser::className(), 'targetAttribute' => ['ideaUserId' => 'id']],
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
            'title' => Yii::t('app', 'Title'),
            'body' => Yii::t('app', 'Body'),
            'createdAt' => Yii::t('app', 'Created At'),
            'ideaUserId' => Yii::t('app', 'Idea User ID'),
            'status' => Yii::t('app', 'Status'),
            'votes' => Yii::t('app', 'Votes'),
            'like' => Yii::t('app', 'Like'),
            'receieveEmail' => Yii::t('app', 'Receieve Email'),
            'siteId' => Yii::t('app', 'Site ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['ideaId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdeaUser()
    {
        return $this->hasOne(Ideauser::className(), ['id' => 'ideaUserId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdeaIps()
    {
        return $this->hasMany(IdeaIp::className(), ['idea_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Reply::className(), ['ideaId' => 'id']);
    }
}
