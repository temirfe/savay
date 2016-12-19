<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Banner */
/* @var $form yii\widgets\ActiveForm */
$names=['article'=>Yii::t('app','Articles'),'event'=>Yii::t('app','Events')]
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'model_name')->dropDownList($names,[]); ?>

    <?= $form->field($model, 'model_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
