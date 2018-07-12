<?php
return [
    'adminEmail' => 'sodowe666@163.com',
    'mdm.admin.configs' => [//用于RBAC扩展包，别删除
//        'db' => 'customDb',
        'userTable' => '{{%admin}}',
        'menuTable' => '{{%menu}}',
//        'cache' => [
//            'class' => 'yii\caching\DbCache',
//            'db' => ['dsn' => 'sqlite:@runtime/admin-cache.db'],
//        ],
    ]
];
