<?php
/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/1/13
 * Time: 11:01
 */

return [
    'site' => [
        'class' => 'backend\modules\site\Module',
        'controllerNamespace' => 'backend\modules\site\controller',
    ],
    'blog' => [//博客模块
        'class' => 'backend\modules\blog\Module',
        'controllerNamespace' => 'backend\modules\blog\controller',
    ],
    'admin' => [//权限管理模式
        'class' => 'mdm\admin\Module',
        //'layout' => 'left-menu',
    ],
    'log' => [//日志模块
        'class' => 'backend\modules\log\Module',
        'controllerNamespace' => 'backend\modules\log\controller',
    ],
];