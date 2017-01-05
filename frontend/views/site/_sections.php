<?php

/* @var $this yii\web\View */
/* @var $queryWord string */
/* @var $ctg string */

use yii\helpers\Html;
$categories=Yii::$app->db->createCommand("SELECT * FROM category")->queryAll();
?>
<div class="sections js_sections">
    <?php
    foreach($categories as $category){
        echo "<span>".Html::a($category['title'],['/article/list','category'=>$category['id']])."</span>";
    }

    echo "<div class='mt20'>";
    echo "<div>".Html::a(Yii::t('app','About us'), ['/about'])."</div>";
    echo "<div>".Html::a(Yii::t('app','Events'), ['/event/list'])."</div>";
    echo "<div>".Html::a(Yii::t('app','Experts'), ['/expert/list'])."</div>";
    echo "<div>".Html::a(Yii::t('app','Our partners'), ['/partners'])."</div>";
    echo "<div>".Html::a(Yii::t('app','Contact'), ['/site/contact'])."</div>";
    echo "</div>";
    ?>
</div>
