<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use frontend\models\Page;
use frontend\models\Banner;
use yii\caching\DbDependency;
use yii\bootstrap\Carousel;

$this->title = "Savay Travel";
$dao=Yii::$app->db;
$banner=$dao->createCommand("SELECT * FROM banner ORDER BY id DESC LIMIT 1")->queryOne();
$msg='';$subtitle='';$banner_article_id=0;
$lang=substr(Yii::$app->language,0,2);
$dep = new DbDependency();
$dep->sql = 'SELECT MAX(last_update) FROM depend WHERE table_name="page"';
$pages = $dao->cache(function ($dao) {
    return Page::find()->where("url='index'")->orderBy('id DESC')->all();
}, 10000, $dep);

$dep_ban = new DbDependency();
$dep_ban->sql = 'SELECT MAX(last_update) FROM depend WHERE table_name="banner"';
$banners = $dao->cache(function ($dao) {
    return Banner::find()->orderBy('id DESC')->all();
}, 10000, $dep_ban);

$carousel = [];

foreach($banners as $k=>$ban){
    switch($lang){
        case "ru": $title=$ban->title_ru; break;
        case "en": $title=$ban->title_en; break;
        case "ky": $title=$ban->title_ky; break;
        case "tr": $title=$ban->title_tr; break;
        default: $title=$ban->title_ru;
    }
    if($ban->url){
        $title.="<br /><p>".Html::a(Yii::t("app","Read more")." <span class='fa fa-chevron-right'></span>",$ban->url,['class'=>'btn btn-primary'])."</p>";
    }
    $carousel [$k]['content']=Html::img('/images/banner/'.$ban->id.'/'.$ban->image);
    $carousel [$k]['caption']="<h1>".$title."</h1>";
}

echo Carousel::widget([
    'items' => $carousel,
    'options' => ['class' => 'carousel slide', 'data-interval' => '120000'],
    'controls' => [
        '<span class="fa fa-chevron-left glyphicon-chevron-left" aria-hidden="true"></span>',
        '<span class="fa fa-chevron-right glyphicon-chevron-right" aria-hidden="true"></span>'
    ]
]);
?>
<br />
<br />

<div class="site-index container pb20">

    <div class="body-content">
            <?php
            if(!empty($pages)){
                foreach($pages as $art){
                    if($art->lang==$lang){
                        ?>
                        <div class="col-md-7 oh p_wrap">
                            <h4 class='roboto mb15 savindigo text-uppercase pb5'><?=$art->title?></h4>
                            <h3><?=Html::a($art->description,['/page/view','id'=>$art->id],['class'=>'mb5 iblock color3 roboto no_underline w100']);?></h3>
                            <?=$art->text?>
                            <?php
                                if($art->fact){
                                    $parts=explode('-',$art->fact);
                                    $number=trim($parts[0]);
                                    $words=explode(" ",trim($parts[1]));
                                    ?>
                                    <div class="experience-box">
                                        <div class="experience-border"></div>
                                        <div class="experience-content">
                                            <div class="experience-number"><?=$number?></div>
                                            <div class="experience-info">
                                                <?php
                                                foreach ($words as $word) {
                                                        echo $word."<br />";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="col-md-5 rel">
                            <?=Html::a(Html::img("/images/page/".$art->id."/s_".$art->image,['class'=>'img-responsive']),['/page/view','id'=>$art->id],['class'=>'rel z100']);?>
                            <div class="dots abs"></div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        <div class="clear"></div>


    </div>
</div>
