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

$articles=Article::find()->orderBy('id DESC')->limit(5)->all();
$events=Event::find()->where('date_end>NOW()')->orderBy('id DESC')->limit(5)->all();
?>
<?php
if(!empty($bmodel)){
    ?>
    <div class="slider_wrap mt-20 mb40">
        <div class="slider"><?=Html::img('/images/'.$banner['model_name'].'/'.$banner['model_id'].'/'.$bmodel->image)?></div>
        <div class="slider_title">
            <div class="text-uppercase bold white mb5 font12"><?=$msg?></div>
            <h1><?= Html::a($bmodel->title,['/'.$banner['model_name'].'/view','id'=>$bmodel->id],['class'=>'white hover_white']) ?></h1>
            <?=$subtitle?>
        </div>
    </div>
<?php
}
?>

<div class="site-index container">

    <div class="body-content">

        <?php
            if($articles){
                echo "<h3 class='emprint mb20 color3d font17'>".Yii::t('app','Articles')."</h3>";
                foreach($articles as $article){
                    echo $this->render('/article/_list',['model' => $article]);
                }
                echo "<div class='mb80'></div>";
            }

            if($events){
                echo "<h3 class='emprint color3d font17 mb20'>".Yii::t('app','Events')."</h3>";
                echo "<div class='row'>";
                foreach($events as $event){
                    echo "<div class='col-md-6'>".$this->render('/event/_list',['model' => $event, 'time'=>'upcoming'])."</div>";
                }
                echo "</div>";
            }
        ?>

    </div>
</div>
