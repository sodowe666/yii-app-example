<?php
namespace backend\modules\log\controller;

use backend\modules\BaseController;

/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/2/6
 * Time: 16:38
 */
class OperationLogController extends BaseController
{
    public function actionIndex()
    {
        return $this->render($this->action->id);
    }
}