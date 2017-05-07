<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\FontAwesomeAsset;
use common\widgets\Alert;
use yii\bootstrap\Modal;

AppAsset::register($this);
FontAwesomeAsset::register($this);
$controller=Yii::$app->controller->id;
$action=Yii::$app->controller->action->id;

if(!isset($user)) $user=Yii::$app->user;
if(!isset($isGuest)) $isGuest=$user->isGuest;
if(!isset($identity)) $identity=$user->identity;
if(!isset($user_id) && $identity) $user_id=$identity->id; else $user_id='';
if(!isset($user_name) && $identity) $user_name=$identity->username; else $user_name='';
if(!isset($user_role) && $identity) $user_role=$identity->role; else $user_role='';
if(!isset($dao)) $dao=Yii::$app->db;

if($controller=='site' && $action=="about") $about_active=true; else $about_active=false;
if($controller=='site' && $action=="partners") $partner_active=true; else $partner_active=false;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="140" id="top">
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '382095758792121',
            xfbml      : true,
            version    : 'v2.8'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    if(!$isGuest && $user_role=='admin'){include_once('_adminpanel.php');}
    //elseif(!$isGuest && $user_role=='Moderator'){include_once('_moderpanel.php');}
    //elseif(!$isGuest && $user_role=='ContentManager'){include_once('_cmanagerpanel.php');}
    ?>
    <?php
    NavBar::begin([
        'brandLabel' => "<div class='logo_wrap  logo_wrap_index js_logo_wrap'></div>",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'mynavbar navbar',
        ],
        'innerContainerOptions'=>['class'=>'nav_wrap container']
    ]);
    $menuItems = [
        ['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('app','About us'), 'url' => ['/about'], 'active'=>$about_active],
        ['label' => Yii::t('app','Contact'), 'url' => ['/site/contact']],
    ];
    $langPrefs = [
        ['label' => Yii::t('app','RU'), 'url' => ['#']],
        ['label' => Yii::t('app','KG'), 'url' => ['#'], 'active'=>$about_active],
        ['label' => Yii::t('app','EN'), 'url' => ['#'],'active'=>$partner_active],
        ['label' => Yii::t('app','TR'), 'url' => ['#']],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
    ]);

    echo "<div class='pull-right mt15'>";
        echo Html::a('Рус','#',['class'=>'gray5 ml10','data'=>['method' => 'post', 'params'=>['language'=>'ru-RU']]]);
        echo Html::a('Кыр','#',['class'=>'gray5 ml10','data'=>['method' => 'post', 'params'=>['language'=>'ky-KG']]]);
        echo Html::a('Eng','#',['class'=>'gray5 ml10','data'=>['method' => 'post', 'params'=>['language'=>'en-EN']]]);
        echo Html::a('Tür','#',['class'=>'gray5 ml10','data'=>['method' => 'post', 'params'=>['language'=>'tr-TR']]]);
    echo "</div>";


    NavBar::end();
    ?>
    <?php /*echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ])*/ ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<footer class="footer">
    <div class="container pb10">
        <!--<div class="pull-left mr10 mt5">
            <?/*=Yii::t('app','Follow us on ')*/?>
        </div>-->
        <!--<div class="text-left">
            <a class="share-facebook share-icon" rel="nofollow" href="https://www.facebook.com/" title="<?/*=Yii::t('app','Facebook');*/?>">
                <span></span>
            </a>
            <a class="share-twitter share-icon" rel="nofollow" href="https://twitter.com/" title="<?/*=Yii::t('app','Twitter');*/?>">
                <span></span>
            </a>
            <a class="share-linkedin share-icon" rel="nofollow" href="#" title="<?/*=Yii::t('app','LinkedIn');*/?>">
                <span></span>
            </a>
            <a class="share-youtube share-icon" rel="nofollow" href="https://www.youtube.com/channel/" title="<?/*=Yii::t('app','YouTube');*/?>">
                <span></span>
            </a>
        </div>-->
        <div class="pull-right">
            <?php
            echo Html::a(Yii::t('app','Search')."<span class='fa fa-search search_icon'></span>", ['/site/search'],
                ['class'=>'search small_nav pr15','data-toggle'=>"modal", 'data-target'=>"#search-modal"]);
            if (Yii::$app->user->isGuest) {
                echo Html::a(Yii::t('app','Login')."<span class='fa fa-sign-in ml5'></span>",['/site/login'],['class'=>'small_nav mt1']);
            } else {
                echo Html::a(Yii::t('app','Logout').' (' . Yii::$app->user->identity->username.")<span class='fa fa-sign-out ml5'></span>",['/site/logout'],['class'=>'small_nav mt1', 'data-method'=>'post']);
            }
            ?>
        </div>
        <p class="mb0 font12"><?=Yii::t('app','All rights reserved.')?> &copy; <?= date('Y') ?></p>
    </div>
</footer>
<a href="#" class="scrollToTop"><span class="fa fa-arrow-up"></span></a>
<?php $this->endBody() ?>
<?php
$modal = Modal::begin([
    'id' => 'search-modal',
    'header' => Html::tag('h4', Yii::t('app', 'Search'), ['class' => 'modal-title']),
]);
echo $this->render('/site/_search_form',['ctg'=>'','queryWord'=>'']);
$modal::end();
?>
</body>
</html>
<?php $this->endPage() ?>
