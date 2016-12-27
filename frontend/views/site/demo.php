<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use frontend\models\Article;
use frontend\models\Event;
use yii\caching\DbDependency;
//$this->title = 'Центр политико-правовых исследований';
$this->title = Yii::t('app','CPLR | Center for political and legal research');
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
$dep = new DbDependency();
$dep->sql = 'SELECT MAX(id) FROM article';
$article = $dao->cache(function ($dao) {
    return Article::find()->where("image<>''")->orderBy('id DESC')->one();
}, 600, $dep);
if($article){
    $articles = $dao->cache(function ($dao) use ($article) {
        return Article::find()->select('id,title')->where("id<>{$article->id}")->orderBy('id DESC')->limit(10)->all();
    }, 600, $dep);
}

//$events=Event::find()->where('date_end>NOW()')->orderBy('id DESC')->limit(5)->all();
$events=Event::find()->orderBy('id DESC')->limit(5)->all();
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

<div class="site-index large-container oh pb20">

    <div class="body-content">
        <div class="col-md-4 oh">
            <?php
            if($events){
                echo "<h3 class='emprint color3d font17 mb20'>".Yii::t('app','Events')."</h3>";
                foreach($events as $event){
                    echo "<div class='mb20'>".$this->render('/event/_list',['model' => $event])."</div>";
                }
            }
            ?>
        </div>
        <div class="col-md-4 oh">
            <?php
            if($article){
                echo "<h3 class='emprint mb20 color3d font17'>".$article->getLangTitle()."</h3>";
                ?>
                <div class='mb1'>
                    <?php
                    if($article->image){
                        $img=Html::img("/images/article/".$article->id."/s_".$article->image,['class'=>'img-responsive']);
                        echo Html::a($img,['/article/view','id'=>$article->id],['class'=>'img-responsive rel js_des_list_img']);

                    }
                    ?>
                </div>

                <div class="oh">
                    <h3><?=Html::a($article->title,['/article/view','id'=>$article->id],['class'=>'black']); ?></h3>
                    <div class="color9 mt10 roboto font13">
                        <div class='afterdot pull-left'><?=$article->getAuthors()?></div>
                        <time class="date"><?=Yii::$app->formatter->asDate($article->date_create)?></time>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="col-md-4 oh">
            <?php
            if(!empty($articles)){
                echo "<h3 class='emprint mb15 color3d font17'>".Yii::t('app','Articles')."</h3>";
                foreach($articles as $article){
                    echo Html::a("<span class='mr4 block pull-left'>—</span><span class='oh block'>".$article->title."</span>",['/article/view','id'=>$article->id],['class'=>'mb5 iblock color3 roboto no_underline w100']);
                }
            }
            ?>
        </div>



    </div>
</div>
