<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$author='';
$author2='';
$author3='';
$and1='';
$and2='';
if($model->expert_id){ $author=Html::a($model->expert->title,['/expert/view','id'=>$model->expert_id],['class'=>'darklink']); }
if($model->expert2_id){$and1=" ".Yii::t('app','and')." "; $author2=Html::a($model->expert2->title,['/expert/view','id'=>$model->expert2_id],['class'=>'darklink']); }
if($model->expert3_id){$and1=", "; $and2=" ".Yii::t('app','and')." "; $author3=Html::a($model->expert3->title,['/expert/view','id'=>$model->expert3_id],['class'=>'darklink']); }
$authors=$author.$and1.$author2.$and2.$author3;
?>
<div class="article-view">

    <div class="slider_wrap mt-20">
        <div class="slider"><?=Html::img('/images/article/'.$model->id.'/'.$model->image)?></div>
        <div class="slider_title">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <div class="container">
        <section class="row article">
            <div class="col-md-8">
                <div class="color9 mt20 mb24 roboto font13">
                    <div class='afterdot pull-left'><?=$authors?></div>
                    <time class="date"><?=Yii::$app->formatter->asDate($model->date_create)?></time>
                </div>

                <?=$model->text;?>
                <?=$model->footnotes;?>
            </div>
            <aside class="col-md-4">
                <?php
                if($authors){
                    ?>
                    <div class="aside-module mt20">
                        <header class="module-header">
                            <h4><?=Yii::t('app','Authors')?></h4>
                        </header>
                        <?php
                            echo $model->showExpert(1,$author);
                            echo $model->showExpert(2,$author2);
                            echo $model->showExpert(3,$author3);
                        ?>
                    </div>
                <?php
                };
                $dir="files/article/".$model->id;
                if(is_dir($dir)){
                    ?>
                    <div class="aside-module mt20">
                        <header class="module-header">
                            <h4><?=Yii::t('app','Download')?></h4>
                        </header>
                        <?php
                        $files=scandir($dir);
                        foreach($files as $file){
                            if($file!='.' && $file!='..'){
                                echo Html::a("<span class='glyphicon glyphicon-file mr5'></span>".$file,'/'.$dir."/".$file, ['class'=>'darklink']);
                            }
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </aside>
        </section>
    </div>

</div>
