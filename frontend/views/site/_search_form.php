<?php

/* @var $this yii\web\View */
/* @var $queryWord string */
/* @var $ctg string */

use yii\helpers\Html;

$categories=['all'=>Yii::t('app','Search everywhere'),'article'=>Yii::t('app','Articles'),'event'=>Yii::t('app','Events'),'expert'=>Yii::t('app','Experts'),'page'=>Yii::t('app','Pages')];

?>
<div class="ask">
    <?= Html::beginForm(['site/search'], 'get') ?>
    <div class="form-group row">
        <!--type, input name, input value, options-->
        <div class="col-md-3 pr0">
            <?=Html::dropDownList('category',$ctg,$categories,['class'=>'form-control'])?>
        </div>
        <div class="col-md-8 rel">
            <?= Html::input('text', 'search', $queryWord, ['class' => 'form-control search_input','minlength'=>3,'placeholder'=>Yii::t('app','Search')]) ?>
            <?= Html::button("<span class='searchicon fa fa-search'></span>", ['class' => 'btn btn-primary abs search_btn', 'type'=>'submit', 'style'=>'top:0;right:0;']) ?>
        </div>

    </div>
    <?= Html::endForm() ?>
</div>
