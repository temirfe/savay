<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Event */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$time=time();
$start=strtotime($model->date_start);
$end=strtotime($model->date_end);
if($end<$time) {$msg='buttu';}
else if($start<$time) {$msg='going';}
else {$msg='emi bolot';}


if(date('d-m', $start)==date('d-m', $end)){
    $start_date= Yii::$app->formatter->asDatetime($model->date_start,'EEEE, d MMMM, y H:mm');
    $end_date= Yii::$app->formatter->asTime($model->date_end,'H:mm');
}
else {
    $start_date= Yii::$app->formatter->asDatetime($model->date_start,'d MMMM H:mm');
    $end_date= Yii::$app->formatter->asDatetime($model->date_end,'H:mm d MMMM, y');
}

if($model->latlong) $map=Html::a("<span class='glyphicon glyphicon-map-marker mr5'></span>".Yii::t('app','Map'),$model->latlong,['target'=>'_blank','class'=>'darklink']);
else $map='';
?>
<?php
    if($model->image){
        ?>
        <div class="slider_wrap mt-20 mb40">
            <div class="slider"><?=Html::img('/images/event/'.$model->id.'/'.$model->image)?></div>
            <div class="slider_title">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
        <?php
    }
    else{
        ?>
        <div class="container"><h1><?= Html::encode($this->title) ?></h1></div>
        <?php
    }
?>
<div class="event-view container">
    <section class="row article">
        <div class="col-md-8">
            <?=$model->text;?>
            <?php if($model->hosted_by) echo Yii::t('app','Hosted By').": ".$model->hosted_by;?>
        </div>
        <aside class="col-md-4">
            <div class="aside-module box_gray">
                <time class="mb10 iblock"><?=$start_date." - ".$end_date;?></time>
                <div class="mb10"><?=$model->place;?></div>
                <div class="ads"><?=$map;?></div>
            </div>
        </aside>
    </section>

</div>
