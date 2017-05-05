<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use frontend\models\Article;
use frontend\models\Event;
use frontend\models\Video;
use yii\caching\DbDependency;
use yii\bootstrap\Carousel;

$this->title = "Savay Travel";
$dao=Yii::$app->db;
$banner=$dao->createCommand("SELECT * FROM banner ORDER BY id DESC LIMIT 1")->queryOne();
$msg='';$subtitle='';$banner_article_id=0;
if(isset($banner['model_name'])){
    if($banner['model_name']=='article'){
        $bmodel=Article::findOne($banner['model_id']);
        $msg=$bmodel->getLangTitle();
        $subtitle="<div class='white mt10 font12 subtitle'><div class='afterdot pull-left'>".$bmodel->getAuthors()."</div>
        <time class='date'>".Yii::$app->formatter->asDate($bmodel->date_create)."</time></div>";
        $banner_article_id=$bmodel->id;
    }
    else if($banner['model_name']=='event'){
        $bmodel=Event::findOne($banner['model_id']);
        $status=$bmodel->getStatus();
        $msg=$status['msg'];

        $date=$bmodel->getDates();
        $subtitle="<div class='white font13 mt10 roboto'>".$date['start']."</div>";
    }
}
$dep = new DbDependency();
$dep->sql = 'SELECT MAX(last_update) FROM depend WHERE table_name="article"';

$owns = $dao->cache(function ($dao) use($banner_article_id) {
    return Article::find()->where("own=1 AND id<>{$banner_article_id}")->orderBy('id DESC')->all();
}, 3600, $dep);
$articles = $dao->cache(function ($dao) {
    return Article::find()->select('id,title')->where("own=0")->orderBy('id DESC')->limit(10)->all();
}, 3600, $dep);


$carousel = [
    [
        'content' => '<img src="/images/img1.jpg"/>',
        'caption' => '<h1>Заголовок</h1><p>Какой-то дополнительный текст</p><p><a href="/article/link/1" class="btn btn-primary">Подробнее <span class="fa fa-chevron-right"></a></p>',
        'options' => []
    ],
    [
        'content' => '<img src="/images/img2.jpg"/>',
        'caption' => '',
        'options' => []
    ],
    [
        'content' => '<img src="/images/img3.jpg"/>',
        'caption' => '',
        'options' => ['class' => 'my-class']
    ]
];

echo Carousel::widget([
    'items' => $carousel,
    'options' => ['class' => 'carousel slide', 'data-interval' => '120000'],
    'controls' => [
        '<span class="fa fa-chevron-left glyphicon-chevron-left" aria-hidden="true"></span>',
        '<span class="fa fa-chevron-right glyphicon-chevron-right" aria-hidden="true"></span>'
    ]
]);
?>

<div class="site-index container oh pb20">

    <div class="body-content">
        lang: <?php echo Yii::$app->language?>
        <div class="col-md-4 oh">
            <?php
            if(!empty($articles)){
                echo "<h3 class='roboto mb15 navy font19 bbthinblue pb5'>".Yii::t('app','Interesting materials')."</h3>";
                foreach($articles as $art){
                    echo Html::a("<span class='mr4 block pull-left'>—</span><span class='oh block'>".$art->title."</span>",['/article/view','id'=>$art->id],['class'=>'mb5 iblock color3 roboto no_underline w100']);
                }
            }
            ?>
        </div>
        <div class="col-md-4 oh">
            <?php
            if($owns){
                echo "<h3 class='roboto mb15 navy font19 bbthinblue pb5'>".Yii::t('app','Center Articles')."</h3>";
                foreach ($owns as $article){
                    ?>
                    <div class="oh mb20">
                        <div class='own_thumb pull-left mr10'>
                            <?php
                            if($article->image){
                                $img=Html::img("/images/article/".$article->id."/s_".$article->image,['class'=>'img-responsive']);
                                echo Html::a($img,['/article/view','id'=>$article->id],['class'=>'img-responsive rel js_des_list_img']);

                            }
                            ?>
                        </div>

                        <div class="oh">
                            <?=Html::a($article->title,['/article/view','id'=>$article->id],['class'=>'black own_title roboto font16']); ?>
                            <div class="color9 mt5 roboto font13">
                                <?php if($authors=$article->getAuthors()){
                                    ?>
                                    <div class='afterdot pull-left'><?=$authors?></div>
                                    <?php
                                } ?>
                                <time class="date"><?=Yii::$app->formatter->asDate($article->date_create)?></time>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="col-md-4 oh">
        </div>

        <div class="clear"></div>


    </div>
</div>
