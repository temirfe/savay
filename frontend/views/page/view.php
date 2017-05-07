<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view container">
    <div class="col-md-1"></div>
    <div class="col-md-8">
        <h1><?= Html::encode($this->title) ?></h1>

        <h3 class="mt0 mb20"><?=$model->description ?></h3>

        <?=$model->text ?>
        <?php
        if($model->image){
            ?>
            <div class="mt20 mb40">
                <?=Html::img('/images/page/'.$model->id.'/'.$model->image,['class'=>'img-responsive'])?>
            </div>
            <?php
        }?>
        <?php
        if($model->fact){
            $parts=explode('-',$model->fact);
            $number=trim($parts[0]);
            $words=explode(" ",trim($parts[1]));
            ?>
            <div class="experience-box">
                <div class="experience-number"><?=$number?></div>
                <div class="experience-info">
                    <?php
                    foreach ($words as $word) {
                        echo $word."<br />";
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>



</div>
