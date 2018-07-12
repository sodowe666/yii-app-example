<?php
/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/2/2
 * Time: 18:18
 */

namespace common\models\mongodb;


use yii\mongodb\ActiveRecord;

/**
 * Class AdminLog
 * @package common\models\mongodb
 * @property string _id
 * @property integer uid
 * @property string email
 * @property string username
 * @property string description
 * @property string route
 * @property integer created_at
 */

class AdminLog extends ActiveRecord
{


    public function attributes()
    {
        return [
            '_id',
            'uid',
            'email',
            'username',
            'description',
            'route',
            'created_at',
            'type',
            'option',
        ];
    }


    public static function collectionName()
    {
        return 'admin_log';
    }

}