<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app','About us').' | '.Yii::t('app','CPLR');
$this->params['breadcrumbs'][] = $this->title;
$row=Yii::$app->db->createCommand("SELECT * FROM page WHERE url='about'")->queryOne();
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
