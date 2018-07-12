<?php
/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/2/6
 * Time: 23:37
 */

namespace backend\assets;


use yii\web\AssetBundle;

/**
 * Adminlte基础资源包
 * Class AdminLteAsset
 * @package backend\assets
 */
class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@adminlte';

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}