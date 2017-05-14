<?php
namespace app\models;

use yii;
use app\models\activerecords\Idea as IdeaDb;

class Idea extends IdeaDb{
    
    public static function getideasByFilter($filter,$offset=0,$count=2){
        
        $ideas = Self::find()
                ->select("idea.*, owner.name as owner_name,owner.email as owner_email,owner.id as owner_user_id"
                        . ",(select count(*) from comment where comment.ideaId = idea.id) as ccnt")
                ->joinWith("ideaUser")
                ->joinWith("site")
                ->join("inner join", "user owner", "{{owner}}.id=site.user_id")
                ->where(['siteId'=> \yii::$app->params['site']->id]);
                
        //echo $ideas->createCommand()->sql;exit;
        switch($filter){
            case 'top':
                $ideas=$ideas->orderBy('idea.votes desc');
                break;
            case 'new':
                //echo 33;exit;
                $ideas=$ideas->orderBy('idea.id desc');                
                break;
            case 'live':               
                $ideas=$ideas->andWhere(['status'=>2]);                
                break;
            case 'rejected':
                $ideas=$ideas->andWhere(['status'=>0]);
                break;
        }
        $ideas =$ideas->offset($offset)
        ->limit($count)        
        ->asArray()->all();   
        
        
        return $ideas;
                
    }   
    
    public static function getIdea($id,$next = false){
        if($next){
            
            $idea = Idea::find()->where(['>', 'idea.id', $id]);
        }else{
            
            $idea = Idea::find()->where(['idea.id'=>$id]);
            
        }
        $idea->select("idea.*, owner.name as owner_name,owner.email as owner_email,owner.id as owner_user_id"
                        . ",(select count(*) from comment where comment.ideaId = idea.id) as ccnt")
                ->joinWith("ideaUser")
                ->joinWith("site")
                ->join("inner join", "user owner", "{{owner}}.id=site.user_id");
                $idea = $idea->joinWith('comments')
                ->asArray()->one();
                
        return $idea;        
    }
    
}
