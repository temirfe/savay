<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app','Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login container">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-primary pl20 pr20', 'name' => 'login-button']) ?>
                </div>


            <div style="color:#999;margin:1em 0; font-size:12px;">
                <?= Html::a(Yii::t('app','Forgot password?'), ['site/request-password-reset']) ?>
                |
                <?= Html::a(Yii::t('app','Create account'), ['site/signup']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
