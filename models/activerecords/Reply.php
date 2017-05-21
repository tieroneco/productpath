<?php

namespace app\models\activerecords;

use Yii;

/**
 * This is the model class for table "reply".
 *
 * @property integer $id
 * @property integer $ideaId
 * @property string $reply
 *
 * @property Idea $idea
 */
class Reply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ideaId'], 'integer'],
            [['reply'], 'string'],
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
            'ideaId' => Yii::t('app', 'Idea ID'),
            'reply' => Yii::t('app', 'Reply'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdea()
    {
        return $this->hasOne(Idea::className(), ['id' => 'ideaId']);
    }
}
