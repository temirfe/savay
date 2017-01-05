<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model frontend\models\Event */
/* @var $amodel frontend\models\Attendant */
$this->title = $model->title.' | '.Yii::t('app','CPLR');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$time=time();
$start=strtotime($model->date_start);
$end=strtotime($model->date_end);
$status=$model->getStatus();
$msg=$status['msg'];
$register=$status['register'];
$date=$model->getDates();
$start_date=$date['start'];
$end_date=$date['end'];

if($model->latlong) $map=Html::a("<span class='glyphicon glyphicon-map-marker mr5'></span>".Yii::t('app','Map'),$model->latlong,['target'=>'_blank','class'=>'darklink']);
else $map='';

$participants=Yii::$app->db->createCommand("SELECT expert_id FROM participant WHERE model_id='{$model->id}' AND model_name='event'")->queryAll();
if($participants){
    $part_ids=array();
    foreach($participants as $p){
        $part_ids[]=$p['expert_id'];
    }
    $pids=implode(',',$part_ids);
    $panelists=Yii::$app->db->createCommand("SELECT * FROM expert WHERE id IN ({$model->id})")->queryAll();
}
?>
<?php
    if($model->image){
        ?>
        <div class="slider_wrap mt-20 mb40">
            <div class="slider"><?=Html::img('/images/event/'.$model->id.'/'.$model->image)?></div>
            <div class="slider_title">
                <div class="text-uppercase bold white mb5 font12"><?=$msg?></div>
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
        <?php
    }
    else{
        ?>

        <div class="container">
            <div class="text-uppercase bold blue font12"><?=$msg?></div>
            <h1 class="event"><?= Html::encode($this->title) ?></h1>
        </div>
        <?php
    }
?>
<div class="event-view container">
    <section class="row">
        <div class="col-md-8">
            <div class="paragraph"><?=$model->text;?></div>
            <?php if($model->hosted_by) echo "<b class='blue'>".Yii::t('app','Hosted By')."</b>: <span class='black'>".$model->hosted_by.'</span>';?>
        </div>
        <aside class="col-md-4">
            <div class="aside-module box_gray">
                <time class="mb10 iblock"><?=$start_date.$end_date;?></time>
                <div class="mb10"><?=$model->place;?></div>
                <div class="ads"><?=$map;?></div>
            </div>
            <?php
                if(Yii::$app->session->hasFlash('registered_for_event')){
                    echo Alert::widget([
                        'options' => ['class' => 'alert-success'],
                        'body' => Yii::$app->session->getFlash('registered_for_event'),
                    ]);
                }
                else{
                    if($register) echo Html::a(Yii::t('app','Register to attend'),'#',['class'=>'btn btn-primary js_register_to_event']);
                    ?>

                    <div class="attendant-form js_attendant_form hiddeniraak">

                        <?php $form = ActiveForm::begin(['action'=>'/attendant/create']); ?>

                        <?= $form->field($amodel, 'fullname')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($amodel, 'email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($amodel, 'organization')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($amodel, 'job_title')->textInput(['maxlength' => true]) ?>
                        <?php $amodel->event_id=$model->id; echo $form->field($amodel, 'event_id')->hiddenInput()->label(false) ?>
                        <?php $amodel->from_event=1; echo $form->field($amodel, 'from_event')->hiddenInput()->label(false) ?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                <?php
                }
            ?>

        </aside>

        <div class="clear mt20 oh">
            <?php
            if(!empty($panelists)){
                echo "<div class='mt20'>";
                echo "<b class='ml15 blue block mb10'>".Yii::t('app','Panelists')."</b>";
                foreach($panelists as $pa){
                    if($pa['image'])
                        $img=Html::img("/images/expert/".$pa['id']."/s_".$pa['image'],['class'=>'round author_image_small']);
                    else {
                        $words = explode(" ", $pa['title']);
                        $acronym = "";

                        foreach ($words as $w) {
                            $acronym .= mb_substr($w, 0, 1);
                        }
                        $img="<div class='round initials_thumb'>".$acronym."</div>";
                    }
                    $url=Html::a($img,['/expert/view','id'=>$pa['id']]);
                    $author=Html::a($pa['title'],['/expert/view','id'=>$pa['id']],['class'=>'darklink']);
                    ?>
                    <div class='mb20 oh col-md-4 mb15'>
                        <div class='pull-left mr15'><?=$url?></div>
                        <h2 class='name'><?=$author?></h2>
                        <span class='font12 color69'><?=$pa['description']?></span>
                    </div>
                    <?php
                }
                echo "</div>";
            }
            ?>
        </div>
    </section>

</div>
