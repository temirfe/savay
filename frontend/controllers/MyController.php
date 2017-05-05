<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use yii\web\ForbiddenHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class MyController extends Controller
{

    public function init()
    {
        parent::init();
        // Set the application language if provided by GET, session or cookie
        if (isset($_POST['language'])) {
            Yii::$app->language = $_POST['language'];
            Yii::$app->session->set('language', $_POST['language']);
            $cookie = new \yii\web\Cookie([
                'name' => 'language',
                'value' => $_POST['language'],
            ]);
            $cookie->expire = time() + (60 * 60 * 24 * 365); // (1 year)
            Yii::$app->response->cookies->add($cookie);
        } else if (Yii::$app->session->has('language'))
            Yii::$app->language = Yii::$app->session->get('language');
        else if (isset(Yii::$app->request->cookies['language'])){
            $lang=Yii::$app->request->cookies['language']->value;
            Yii::$app->language = $lang;
            Yii::$app->session->set('language', $lang);
        }

    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        if($this->id=='user' && $this->action->id=='view'){
            $view=[
                'actions' => ['view'],
                'allow' => true,
                'roles' => ['admin'],
            ];
        }
        else{
            $view=[
                'actions' => ['view'],
                'allow' => true,
                'roles' => ['?','@'],
            ];
        }
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'logout' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create','update','delete'],
                        'allow' => true,
                        'roles' => ['crud'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['crud'],
                    ],
                    [
                        'actions' => ['list'],
                        'allow' => true,
                        'roles' => ['?','@'],
                    ],
                    $view,
                ],
            ],
        ];
    }
}
