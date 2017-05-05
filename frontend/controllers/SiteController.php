<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;
use yii\db\Query;
use yii\helpers\ArrayHelper;
/**
 * Site controller
 */
class SiteController extends MyController
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionEditorUpload(){
        $file=UploadedFile::getInstanceByName('upload');
        $imageName=time().'.'.$file->extension;
        $dir=Yii::getAlias('@webroot')."/images/editor/";
        $file->saveAs($dir.'/' . $imageName);
    }
    public function actionEditorBrowse(){
        return $dir=Yii::getAlias('@webroot')."/images/editor/";
    }
    /**
     * Displays homepage.
     *
     * @return mixedh
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDemo()
    {
        $this->layout='//empty';
        return $this->render('under_construction');
    }
    
    public function actionSearch()
    {
        $page='';
        $expert='';
        $article='';
        $event='';
        
        $queryWord=Yii::$app->request->get('search');
        $ctg=Yii::$app->request->get('category');
        if(Yii::$app->language=='ru'){$langInt='1';} else{$langInt='0';}
        if($queryWord && strlen($queryWord)>=3)
        {
            //$results=$pages||$news || $events ? array_merge($pages, $news, $events):null;

            $query=new Query();
            if($ctg=='all' || $ctg=='page'){
                $page=$query->select(['id', 'title','text'])
                    ->from('page')
                    ->where("title LIKE :search OR text LIKE :search", [':search' =>"%{$queryWord}%"])
                    ->all();
            }
            if($ctg=='all' || $ctg=='article'){
                $article=$query->select(['id', 'title','text','image'])
                    ->from('article')
                    ->where("title LIKE :search OR text LIKE :search", [':search' =>"%{$queryWord}%"])
                    ->all();
            }
            if($ctg=='all' || $ctg=='event'){
                $event=$query->select(['id', 'title','text'])
                    ->from('event')
                    ->where("title LIKE :search OR text LIKE :search", [':search' =>"%{$queryWord}%"])
                    ->all();
            }
            if($ctg=='all' || $ctg=='expert'){
                $expert=$query->select(['id', 'title','description','image'])
                    ->from('expert')
                    ->where("content LIKE :search", [':search' =>"%{$queryWord}%"])
                    ->all();
            }
            /*$decree=$query->select(['id', 'title','content'])
                ->from('decree')
                ->where("ru='{$langInt}' AND (title LIKE :search OR content LIKE :search)", [':search' =>"%{$_POST['search']}%"])
                ->all();
            $gallery=$query->select(['id', 'title','title_ru','description','description_ru'])
                ->from('gallery')
                ->where('title LIKE :search OR title_ru LIKE :search OR description LIKE :search or description_ru LIKE :search', [':search' =>"%{$_POST['search']}%"])
                ->all();*/
        }
        return $this->render('searchResult',[
            'page'=>$page,
            'article'=>$article,
            'event'=>$event,
            'expert'=>$expert,
            'langInt'=>$langInt,
            'queryWord'=>$queryWord,
            'ctg'=>$ctg
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionPartners()
    {
        return $this->render('partners');
    }

    public function actionExplore()
    {
        $dao=Yii::$app->db;
        $cities=$dao->createCommand("SELECT id,title, image FROM city")->cache(86000)->queryAll();
        return $this->render('explore',['cities'=>$cities]);
    }

    public function actionDestinations()
    {
        //$dao=Yii::$app->db;
        //$cities=$dao->createCommand("SELECT id,title, image FROM city")->cache(86000)->queryAll();
        return $this->render('destinations',['cities'=>'']);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionImgDelete($id,$model_name)
    {
        $key=Yii::$app->request->post('key');
        $webroot=Yii::getAlias('@webroot');
        if(is_dir($dir=$webroot."/images/{$model_name}/".$id))
        {
            if(is_file($dir.'/'.$key)){
                $expl=explode('_',$key);
                $full=$expl[1];
                @unlink($dir.'/'.$key);
                @unlink($dir.'/'.$full);
                Yii::$app->db->createCommand("UPDATE {$model_name} SET image='' WHERE id='{$id}'")->execute();
            }
        }
        Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        return true;
    }

    public function actionFileDelete($id,$model_name)
    {
        $key=Yii::$app->request->post('key');
        $webroot=Yii::getAlias('@webroot');
        if(is_dir($dir=$webroot."/files/{$model_name}/".$id))
        {
            if(is_file($dir.'/'.$key)){
                unlink($dir.'/'.$key);
            }
        }
        Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        return true;
    }
}
