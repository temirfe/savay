<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use frontend\models\Article;
use frontend\models\Event;
//$this->title = 'Центр политико-правовых исследований';
$this->title = 'ЦППИ';
$dao=Yii::$app->db;
$banner=$dao->createCommand("SELECT * FROM banner ORDER BY id DESC LIMIT 1")->queryOne();
$msg='';$subtitle='';
if(isset($banner['model_name'])){
    if($banner['model_name']=='article'){
        $bmodel=Article::findOne($banner['model_id']);
        $msg=$bmodel->getLangTitle();
        $subtitle="<div class='white mt10 font12 subtitle'><div class='afterdot pull-left'>".$bmodel->getAuthors()."</div>
        <time class='date'>".Yii::$app->formatter->asDate($bmodel->date_create)."</time></div>";
    }
    else if($banner['model_name']=='event'){
        $bmodel=Event::findOne($banner['model_id']);
        $status=$bmodel->getStatus();
        $msg=$status['msg'];

        $date=$bmodel->getDates();
        $subtitle="<div class='white font13 mt10 roboto'>".$date['start']."</div>";
    }
}
?>
<?php
if(!empty($bmodel)){
    ?>
    <div class="slider_wrap mt-20 mb40">
        <div class="slider"><?=Html::img('/images/'.$banner['model_name'].'/'.$banner['model_id'].'/'.$bmodel->image)?></div>
        <div class="slider_title">
            <div class="text-uppercase bold white mb5 font12"><?=$msg?></div>
            <h1><?= Html::encode($bmodel->title) ?></h1>
            <?=$subtitle?>
        </div>
    </div>
<?php
}
?>

<div class="site-index container">

    <div class="body-content">

        <h3>Special offers</h3>
        <div class="row">
            <?php
            /*foreach($packages as $pack){
                */?><!--
                <div class="col-md-4 rel img_pack_box">
                    <div class="img_pack_wrap">
                        <?php
/*                        $img=Html::img("/images/package/".$pack['id']."/s_".$pack['image'],['class'=>'img-responsive']);
                        echo "<div class=''>".Html::a($img,['package/view','id'=>$pack['id']])."</div>";
                        */?>

                        <div class="img_pack_title pad15">
                            <h4 class="mt0 mb2">
                                <?/*=Html::a($pack['title']."<span class='false_link'></span>",['package/view','id'=>$pack['id']],['class'=>'no_underline black']);*/?>
                            </h4>
                            <div class="img_pack_text"><?/*=$pack['description'];*/?></div>
                        </div>
                            
                    </div>
                </div>
                --><?php
/*            }*/
            ?>
        </div>

        <br />
        <h3>Explore <span class="highlight gold">POLITICS</span> with us</h3>
        <div class="row">
            <?php
            /*foreach($cities as $city){
                */?><!--
                <div class="col-sm-3 rel img_thumb_box">
                    <div class="photo_thumb">
                        <?php
/*                        $img=Html::img("/images/city/".$city['id']."/s_".$city['image'],['class'=>'img-responsive']);
                        echo Html::a($img,['city/view','id'=>$city['id']]);
                        */?>
                    </div>

                    <div class="abs img_title"><span><?/*=Html::a($city['title']."<div class='false_link'></div>",['city/view','id'=>$city['id']],['class'=>'no_underline']);*/?></span></div>
                </div>
                --><?php
/*            }*/
            ?>
        </div>

    </div>
</div>
