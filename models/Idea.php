<?php
namespace app\models;

use yii;
use app\models\activerecords\Idea as IdeaDb;

class Idea extends IdeaDb{
    
    public static function getideasByFilter($filter,$offset=0,$count=2,$q=''){
        $role=\Yii::$app->authManager->getRolesByUser(\yii::$app->user->id);
        $ideas = Self::find()
                ->select("idea.*, owner.name as owner_name,owner.email as owner_email,owner.id as owner_user_id"
                        . ",(select count(*) from comment where comment.ideaId = idea.id) as ccnt,iip.ip")
                ->joinWith("ideaUser")
                ->joinWith("site")
                ->join("inner join", "user owner", "{{owner}}.id=site.user_id")
                ->join("left join",'idea_ip iip',"{{iip}}.idea_id = idea.id and {{iip}}.ip='". \yii::$app->request->getUserIP()."'")
                ->where(['siteId'=> \yii::$app->params['site']->id]);
        if(!isset($role['admin'])){
            $ideas = $ideas->andWhere(['!=','status',-1]);
        }
                
                
        //echo $ideas->createCommand()->sql;exit;
        switch($filter){
            case 'top':                
                $ideas=$ideas->orderBy('idea.votes desc');
                break;
            case 'new':                
                $ideas=$ideas->orderBy('idea.id desc');                
                break;
            case 'live':               
                $ideas=$ideas->andWhere(['status'=>2]);                
                break;
            case 'rejected':
                $ideas=$ideas->andWhere(['status'=>0]);
                break;
            case 'search':                
                $ideas=$ideas->andWhere(['like','body',$q])->orWhere(['like','title',$q]);
        }
        $ideas =$ideas->offset($offset)
        ->limit(\yii::$app->params['defaultLimit'])->asArray()->all();   
        
        
        return $ideas;
                
    }   
    
    public static function getIdea($id,$next = false){
        
        $role=\Yii::$app->authManager->getRolesByUser(\yii::$app->user->id);
        if($next){
            
            $idea = Idea::find()->where(['>', 'idea.id', $id]);
        }else{
            
            $idea = Idea::find()->where(['idea.id'=>$id]);
            
        }
        $idea = $idea->andWhere(['=','s.id',\yii::$app->params['site']->id]);
        if(!isset($role['admin'])){
            $idea = $idea->andWhere(['!=','status',-1]);
        }
        $idea->select("idea.*, owner.name as owner_name,owner.email as owner_email,owner.id as owner_user_id"
                        . ",(select count(*) from comment where comment.ideaId = idea.id) as ccnt,iip.ip")
                ->joinWith("ideaUser i")
                ->joinWith("site s")
                ->join("left join",'idea_ip iip',"{{iip}}.idea_id = idea.id and {{iip}}.ip='". \yii::$app->request->getUserIP()."'")
                ->join("inner join", "user owner", "{{owner}}.id=s.user_id");
        
                $idea = $idea->joinWith('comments.commentUser')->joinWith('replies')
                ->asArray()->one();
                
        return $idea;        
    }
    
    
    
}
