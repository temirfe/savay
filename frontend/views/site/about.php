<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app','About us').' | Savay Travel';
$this->params['breadcrumbs'][] = $this->title;
$lang=substr(Yii::$app->language,0,2);
$row=Yii::$app->db->createCommand("SELECT * FROM page WHERE url='about' AND lang='{$lang}'")->queryOne();
?>
<div class="site-about container">
    <div class="row">
        <div class="col-md-9 img_resp paragraph">
            <h1><?= Html::encode($row['title']) ?></h1>
            <br />
            <?=$row['text']?>
        </div>
    </div>

</div>
