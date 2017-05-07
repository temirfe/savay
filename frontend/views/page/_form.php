<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;
use iutbay\yii2kcfinder\KCFinder;

/* @var $this yii\web\View */
/* @var $model frontend\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    <?= $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'lang')->dropDownList(['ru'=>'Русский','ky'=>'Кыргызча', 'en'=>'English', 'tr'=>'Türkçe']) ?></div>
    </div>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'custom',
        'clientOptions'=>[
            'allowedContent'=>true,
            //'extraAllowedContent'=>'span(*);div(*)[*]{*};h2(*)',
            /*'enterMode' => 2,
            'forceEnterMode'=>false,
            'shiftEnterMode'=>1,*/
            'toolbar'=>[ //toolbar names can be found here: http://docs.cksource.com/CKEditor_3.x/Developers_Guide/Toolbar
                ['name'=>'document','items'=>['Source']],
                ['name'=>'basicstyles','items'=>['Bold','Italic','Underline','Strike','-','TextColor','BGColor','-','RemoveFormat']],
                ['name'=>'Clipboard','items'=>['Paste','PasteText','PasteFromWord']],
                ['name'=>'insert','items'=>['Image','Table','HorizontalRule']],
                ['name'=>'paragraph','items'=>['NumberedList','BulletedList','-','Outdent','Indent']],
                ['name'=>'links','items'=>['Link','Unlink']],
                ['name'=>'styles','items'=>['Styles','Format','Font','FontSize']],
                ['name'=>'tools','items'=>['Maximize']],
            ]
        ]
    ]) ?>
    
    <?php
    $key = $model->id;
    $url = Url::to(['site/img-delete', 'id' => $key, 'model_name'=>'page']);

    $initialPreviewConfig =[];
    if(!$model->isNewRecord && $main_img=$model->image) {
        $iniImg=[Html::img("@web/images/page/".$model->id."/s_".$main_img, ['class'=>'file-preview-image', 'alt'=>''])];
        $url=Url::to(['site/img-delete', 'id' => $model->id, 'model_name'=>'page']);
        $initialPreviewConfig[] = ['width' => '80px', 'url' => $url, 'key' => "s_".$main_img];
    }
    else {
        $iniImg=false;
    }
    echo $form->field($model, 'imageFile')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'initialPreview'=>$iniImg,
            'previewFileType' => 'any',
            'uploadUrl' => Url::to(['/site/img-upload','id'=>$model->id]),
            'initialPreviewConfig' => $initialPreviewConfig,
        ],
    ]);

    ?>

    <?php echo $form->field($model, 'fact')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'category')->dropDownList(["0"=>"General","1"=>"Explore UAE with us", "2"=>"Destinations of your interest"],[]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
