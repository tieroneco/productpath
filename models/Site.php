<?php
namespace app\models;

use app\models\activerecords\Site as SiteDb;

class Site extends SiteDb{
    
    public function rules(){
        $rules = parent::rules();        
        return array_merge($rules, [['subDomain','unique', 'message'=>'{value} is already used' ]]);
    }
}