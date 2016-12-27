<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Article */

$this->title = $model->title.' | '.Yii::t('app','CPLR');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->view->registerMetaTag(['property' => 'og:title','content' => $model->title]);
Yii::$app->view->registerMetaTag(['property' => 'og:image','content' => 'http://center.kg/images/article/'.$model->id.'/'.$model->image]);
Yii::$app->view->registerMetaTag(['property' => 'og:description','content' => $model->title]);
Yii::$app->view->registerMetaTag(['property' => 'og:url','content' => Yii::$app->request->absoluteUrl]);
?>

<div class="article-view">
    <?php
    if($model->image){
        ?>
        <div class="slider_wrap mt-20 mb40">
            <div class="slider"><?=Html::img('/images/article/'.$model->id.'/'.$model->image)?></div>
            <div class="slider_title">
                <div class="text-uppercase bold white mb5 font12"><?=$model->getLangTitle()?></div>
                <h1><?= Html::encode($model->title) ?></h1>
            </div>
        </div>
        <?php
    }
    else{
        ?>

        <div class="container">
            <div class="text-uppercase bold blue font12"><?=$model->getLangTitle()?></div>
            <h1 class="event"><?= Html::encode($model->title) ?></h1>
        </div>
        <?php
    }
    ?>

    <div class="container">
        <section class="row article">
            <div class="col-md-8">
                <div class="mb10">
                    <a class="share-facebook share-icon js_fb_share" rel="nofollow" href="<?=Yii::$app->request->absoluteUrl?>" title="<?=Yii::t('app','Click to share on Facebook');?>">
                        <span></span>
                    </a>
                    <a class="share-twitter share-icon popup twitter-share-button" rel="nofollow" href="https://twitter.com/intent/tweet?text=<?=urlencode($model->title).'&url='.Yii::$app->request->absoluteUrl?>" data-title="Twitter" title="<?=Yii::t('app','Click to share on Twitter');?>">
                        <span></span>
                    </a>
                    <a class="share-linkedin share-icon popup" rel="nofollow"
                       href="https://www.linkedin.com/shareArticle?mini=true&url=<?=Yii::$app->request->absoluteUrl?>&title=<?=urlencode($model->title)?>"
                       title="<?=Yii::t('app','Click to share on LinkedIn');?>">
                        <span></span>
                    </a>
                    <a class="share-email share-icon" href="mailto:?subject=<?=$model->title?>&body=<?=Yii::$app->request->absoluteUrl?>" title="<?=Yii::t('app','Email this page');?>" rel="nofollow">
                        <span></span>
                    </a>
                    <a class="share-print share-icon" href="http://printfriendly.com" onclick="window.print();return false" style="text-decoration: none; color: #6D9F00;" title="<?=Yii::t('app','Click to print');?>" rel="nofollow">
                        <span></span>
                    </a>
                </div>
                <div class="color9 mt20 mb24 roboto font13">
                    <?php
                        if($authors=$model->getAuthors()){
                            echo "<div class='afterdot pull-left'>{$authors}</div>";
                        }
                    ?>
                    
                    <time class="date"><?=Yii::$app->formatter->asDate($model->date_create)?></time>
                </div>
                <?=$model->text;?>
                <?=$model->footnotes;?>
            </div>
            <aside class="col-md-4">
                <?php
                if($model->expert_id || $model->expert2_id ||$model->expert3_id){
                    ?>
                    <div class="aside-module mt20">
                        <header class="module-header">
                            <h4><?=Yii::t('app','Authors')?></h4>
                        </header>
                        <?php
                            echo $model->showExpert(1,$model->getAuthorLink(1));
                            if($model->expert2_id) echo $model->showExpert(2,$model->getAuthorLink(2));
                            if($model->expert3_id) echo $model->showExpert(3,$model->getAuthorLink(3));
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
