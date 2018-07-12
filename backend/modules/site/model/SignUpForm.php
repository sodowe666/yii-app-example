<?php
/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/1/13
 * Time: 17:00
 */

namespace backend\modules\site\model;


use common\models\mysql\Admin;
use yii\base\Model;

class SignUpForm extends Model
{

    public $username;
    public $password;
    public $email;

    public function rules()
    {
        $min_password = 6;
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message' => '用户名不能为空'],
            ['username', 'unique', 'targetClass' => '\common\models\mysql\Admin', 'message' => '用户名已存在'],
            ['username', 'string', 'min' => 2, 'max' => 100],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => '邮箱不能为空'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\mysql\Admin', 'message' => '邮箱已存在'],
            ['password', 'required', 'message' => '密码不能为空'],
            ['password', 'string', 'min' => $min_password, 'tooShort' => '密码最少要' . $min_password . '位'],
        ];
    }


    /**
     * 注册方法
     * @return bool
     */
    public function signUp()
    {
        if (!$this->validate()) return false;
        $admin = new Admin();
        $admin->username = $this->username;
        $admin->email = $this->email;
        $admin->setPassword($this->password);
        $admin->generateAuthKey();
        return $admin->insert();
    }
}