<?php

namespace common\components;

use Predis\Connection\Aggregate\RedisCluster;
use yii\base\BaseObject;

/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/7/16
 * Time: 18:40
 */
class Redis extends BaseObject
{
    protected $_redis = null;
    public $hosts;


    public function init()
    {
        if ($this->_redis == null) {
            $this->_redis = new RedisCluster(null, $this->hosts);
        }
    }

    public function __call()
    {
    }
}