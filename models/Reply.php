<?php
namespace app\models;
use app\models\activerecords\Reply as ReplyDb;

class Reply extends ReplyDb{
    
    function rules(){
        $parent_rules = parent::rules();
        $rules = [
          ['reply','required']  
        ];
        
        return array_merge($parent_rules, $rules);
    }
}