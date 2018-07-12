<?php
/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/1/15
 * Time: 00:56
 */

namespace backend\modules\site\controller;


use backend\modules\BaseController;

class RbacController extends BaseController
{

    public function actionInit()
    {
        $auth = \Yii::$app->getAuthManager();
        //添加权限
        $blog_index_index = $auth->createPermission('/blog/index/index');
        $blog_index_index->description = '博客首页';
        $auth->add($blog_index_index);

        //创建一个角色 "总经理"
        $blog_manager = $auth->createRole('总经理');
        $auth->add($blog_manager);
        $auth->addChild($blog_manager,$blog_index_index);

        //给角色分配用户
        $auth->assign($blog_manager,\Yii::$app->getUser()->identity->getId());
    }

    public function actionIndex()
    {
        
    }
}