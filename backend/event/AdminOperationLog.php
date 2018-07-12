<?php
/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/2/4
 * Time: 00:19
 */

namespace backend\event;


use common\models\mongodb\AdminLog;
use yii\base\Event;
use yii\db\AfterSaveEvent;
use yii\helpers\Url;

class AdminOperationLog
{


    public static function className()
    {
        return get_called_class();
    }

    /**
     * @param AfterSaveEvent $event
     */
    public static function insertLog(AfterSaveEvent $event)
    {
        $sender = $event->sender;
        if (!($sender instanceof AdminLog)) { //非admin_log时，把数据插入admin_log
            $arr = [];
            foreach ($sender as $key => $val) {
                $arr[$key] = $val;
            }
            $description = json_encode($arr);
            $model = new AdminLog();
            $data = [
                'route' => Url::to(),
                'uid' => \Yii::$app->getUser()->getIdentity()->getId(),
                'email' => \Yii::$app->getUser()->getIdentity()->email,
                'username' => \Yii::$app->getUser()->getIdentity()->username,
                'created_at' => time(),
                'description' => $description,
                'type' => 1,
                'option' => 'insert',
            ];
            $model->setAttributes($data,false);
            $model->save(false);
        }
    }

    /**
     * @param AfterSaveEvent $event
     */
    public static function updateLog(AfterSaveEvent $event)
    {
        $sender = $event->sender;
        if (!($sender instanceof AdminLog) && !empty($event->changedAttributes)) {
            $arr['changedAttributes'] = $event->changedAttributes;
            $arr['oldAttributes'] = [];
            foreach ($sender as $name => $val) {
                $arr['oldAttributes'][$name] = $val;
            }
            $description = [];
            foreach ($arr['changedAttributes'] as $name => $changedAttribute) {
                $description[] = $name.':' .$changedAttribute.'->'.$arr['oldAttributes'][$name].' ';
            }
            $description = implode(',',$description);
            $model = new AdminLog();
            $data = [
                'route' => Url::to(),
                'uid' => \Yii::$app->getUser()->getIdentity()->getId(),
                'email' => \Yii::$app->getUser()->getIdentity()->email,
                'username' => \Yii::$app->getUser()->getIdentity()->username,
                'created_at' => time(),
                'description' => $description,
                'type' => 2,
                'option' => 'update',
            ];
            $model->setAttributes($data,false);
            $model->save(false);

        }
    }

    /**
     * @param Event $event
     */
    public static function deleteLog(Event $event)
    {
        $sender = $event->sender;
        if (!($sender instanceof AdminLog)) {
            $arr = [];
            foreach ($sender as $name => $val) {
                $arr[$name] = $val;
            }
            $description = json_encode($arr);
            $model = new AdminLog();
            $data = [
                'route' => Url::to(),
                'uid' => \Yii::$app->getUser()->getIdentity()->getId(),
                'email' => \Yii::$app->getUser()->getIdentity()->email,
                'username' => \Yii::$app->getUser()->getIdentity()->username,
                'created_at' => time(),
                'description' => $description,
                'type' => 3,
                'option' => 'delete',
            ];
            $model->setAttributes($data,false);
            $model->save(false);
        }
    }
}