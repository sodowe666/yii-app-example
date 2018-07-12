<?php
/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/2/6
 * Time: 18:05
 */

namespace backend\assets\adminlte;


use yii\web\AssetBundle;

class LogTableAsset extends AssetBundle
{
    public $sourcePath = '@adminlte';

    public $css = [
        'bower_components/font-awesome/css/font-awesome.min.css',
        'bower_components/Ionicons/css/ionicons.min.css',
        'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',

    ];
    public $js = [
        'bower_components/datatables.net/js/jquery.dataTables.min.js',
        'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
        'bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
        'bower_components/fastclick/lib/fastclick.js',
        'dist/js/demo.js'
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}