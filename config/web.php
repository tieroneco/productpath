<?php
$http = 'http://';

if(isset($_SERVER['HTTPS'])){
	$http = 'https://';
}
$host_name = 'hirewpexpert.com';
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],    
    'layout'=>'frontend',    
    'components' => [
        'authManager'=>[
            'class'=> '\yii\rbac\DbManager'
        ],
        'assetManager'=>[
            'bundles'=>[
                'yii\web\JqueryAsset'=>[
                    'sourcePath'=>null,
                    'js'=>[
                        'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'
                    ]
                ]
            ]
               
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'JnnOfBsGE7PSMypg9Om483A-5R7D_kaL',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => '173.194.65.108',
            'username' => 'mahtab.dev@gmail.com',
            'password' => 'Mahtab321',
            'port' => '587',
            'encryption' => 'tls',
        ],
            
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [                
                $http.$host_name.'<all:.*>' =>'main<all>',                
                'get-ideas/<filter:\w+>'=>'site/get-ideas',
                'submit'=>'site/submit',
                '<action:(up|down)>'=>'site/<action>',
                'getIdea/<id:\d+>'=>'site/idea'
            ],
        ],
        
    ],
    'params' => $params,
];
$config['modules']['main']=['class'=>'app\modules\main\Module'];
$config['bootstrap'][] = 'main';
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
