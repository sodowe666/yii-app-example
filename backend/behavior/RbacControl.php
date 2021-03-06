<?php
/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/1/29
 * Time: 11:51
 */

namespace backend\behavior;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;
use yii\web\User;

class RbacControl extends ActionFilter
{

    public $allowActions = [];

    /**
     * @param \yii\base\Action $action
     * @return bool|\yii\web\Response
     */
    public function beforeAction($action)
    {


        if (Yii::$app->getUser()->getIsGuest()){
           return Yii::$app->getUser()->loginRequired();
        }

        $action_id = '/'.$action->getUniqueId();
        if (in_array($action_id,$this->allowActions) || in_array('*',$this->allowActions)) {
            return true;
        }

        $user_id = Yii::$app->getUser()->getIdentity()->getId();
        $authManager = Yii::$app->getAuthManager();
        $permissions = $authManager->getPermissionsByUser($user_id);
        if (empty($permissions[$action_id])) {
            $this->denyAccess(Yii::$app->getUser());
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }


    protected function denyAccess(User $user)
    {

        throw new ForbiddenHttpException('不允许访问');
    }
}