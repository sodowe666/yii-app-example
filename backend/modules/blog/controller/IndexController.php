<?php

/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/1/15
 * Time: 01:01
 */

namespace backend\modules\blog\controller;

use backend\modules\BaseController;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        return $this->render($this->action->id,[]);
    }

}