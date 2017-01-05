<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Video */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$width = '800px';
$height = '450px';
$src="https://www.youtube.com/embed/{$model->video_id}";
?>
<div class="video-view container">

    <h1><?= Html::encode($this->title) ?></h1>

    <iframe id="ytplayer" width="<?php echo $width ?>" height="<?php echo $height ?>"
            src="<?=$src ?>" frameborder="0" allowfullscreen></iframe>

    <br />
    <div class="mt10">
        <?=$model->description;?>
        <div class="mt10">
            <time class="date"><?=Yii::$app->formatter->asDate($model->date_create)?></time>
        </div>
    </div>
</div>
