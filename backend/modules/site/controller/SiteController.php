<?php
/**
 * Created by PhpStorm.
 * User: jqz
 * Date: 2018/1/13
 * Time: 11:30
 */

namespace backend\modules\site\controller;

use backend\modules\BaseController;
use backend\modules\site\model\SignUpForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use backend\modules\site\model\LoginForm;

class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionError()
    {
        echo 31231;
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignUp()
    {
        $model = new SignUpForm();
        if (Yii::$app->getRequest()->getIsPost() && $model->load(Yii::$app->getRequest()->post()) && $model->signUp()) {
            return $this->redirect(['index']);
        }
        $data['model'] = $model;
        return $this->render($this->action->id,$data);
    }
}