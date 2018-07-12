<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'language' => 'zh-CN',//目标语言，前端看到的
    'sourceLanguage' => 'en-Us',//源语言，写代码用的语言
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'site/site/index',
    'as access' => [
        'class' => \mdm\admin\components\AccessControl::className(),
        'allowActions' => [
            '*'
        ],
    ],
    'on beforeRequest' => function () {//绑定beforeRequest事件，触发时绑定AR事件
        \yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_INSERT, [\backend\event\AdminOperationLog::className(), 'insertLog']);
        \yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_DELETE, [\backend\event\AdminOperationLog::className(), 'deleteLog']);
        \yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_UPDATE, [\backend\event\AdminOperationLog::className(), 'updateLog']);

    },
    'aliases' => require 'aliases.php',//引入别名配置
    'bootstrap' => ['log'],
    'modules' => require 'modules.php',//引入模块配置
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\Mysql\Admin',
            'enableAutoLogin' => true,
            'enableSession' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => '/site/site/login',//设置退出跳转登录页面
            'idParam' => 'admin-id',
            'returnUrlParam' => 'admin-returnUrl',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'errorHandler' => [
            'errorAction' => 'site/site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require 'url-rules.php',
        ],
        'assetManager' => [
            'linkAssets' => true,
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-green',
                ],
            ],
            'assetMap' => [//文件映射，Asset包里会进行替换
                //'jquery.js' => '@web/js/jquery-2.1.4.js'//jquery3.0不兼容，映射到2.1.4版本
            ]
        ],
        'i18n' => [
            'translations' => [
                'rbac-admin' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@mdm/admin/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'rbac-admin' => 'rbac-admin.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
