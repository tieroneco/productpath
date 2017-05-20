<?php
namespace app\models;
use app\models\activerecords\Comment as CommentDb;

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
class Comment extends CommentDb
{
}
