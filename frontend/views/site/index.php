<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use frontend\models\Article;
use frontend\models\Event;
use frontend\models\Video;
use yii\caching\DbDependency;
//$this->title = 'Центр политико-правовых исследований';
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

//$events=Event::find()->where('date_end>NOW()')->orderBy('id DESC')->limit(5)->all();
$events=Event::find()->orderBy('id DESC')->limit(5)->all();
$videos=Video::find()->orderBy('id DESC')->limit(6)->all();
?>
<?php
if(!empty($bmodel)){
    ?>
    <div class="slider_wrap mt-20 mb40">
        <div class="slider">
            <?php
            $slider_img=Html::img('/images/'.$banner['model_name'].'/'.$banner['model_id'].'/'.$bmodel->image);
            echo Html::a($slider_img,['/'.$banner['model_name'].'/view','id'=>$bmodel->id]);
            ?>
        </div>
        <div class="slider_title">
            <div class="text-uppercase bold white mb5 font12"><?=$msg?></div>
            <h1><?= Html::a($bmodel->title,['/'.$banner['model_name'].'/view','id'=>$bmodel->id],['class'=>'white hover_white']) ?></h1>
            <?=$subtitle?>
        </div>
    </div>
<?php
}
?>

<div class="site-index large-container oh pb20">

    <div class="body-content">
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
            <?php
            if($events){
                echo "<h3 class='roboto mb15 navy font19 bbthinblue mb20 pb5'>".Yii::t('app','Events')."</h3>";
                foreach($events as $event){
                    echo "<div class='mb20 oh'>".$this->render('/event/_list',['model' => $event])."</div>";
                }
            }
            ?>
        </div>

        <div class="clear"></div>
        <br />
        <div class="mt20 large-container">
            <h3 class="roboto mb15 navy font19 bbthinblue pb5"><?=Yii::t('app','Media')?></h3>
            <div class="row">
                <div class="col-md-9">
                    <?php
                    $v=0; $vdisplay='';
                    foreach($videos as $video){
                        $src="https://www.youtube.com/embed/{$video->video_id}";
                        if($v>0) $vdisplay='hiddeniraak';
                        ?>
                        <div class="video <?=$vdisplay?> js_vid" data-video="<?=$video->video_id?>">
                            <iframe id="vid-<?=$video->video_id?>" src="<?=$src ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <?php
                        $v++;
                    }
                    ?>
                </div>
                <div class="col-md-3 pl5">
                    <div class="vid_thumbs">
                        <?php
                        foreach($videos as $video){
                            $vimg=Html::img($video->thumb,['class'=>'img-responsive']);
                            echo "<div class='mb20 rel pr5'>"
                                .Html::a($vimg.$video->title,['/video/view','id'=>$video->id],['class'=>'js_vid_thumb', 'data-id'=>$video->video_id])
                                ."<span class='abs tube iblock'></span></span></div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
