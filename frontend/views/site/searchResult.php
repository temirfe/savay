<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $queryWord frontend\controllers\SiteController */
/* @var $page frontend\controllers\SiteController */
/* @var $article frontend\controllers\SiteController */
/* @var $event frontend\controllers\SiteController */
/* @var $expert frontend\controllers\SiteController */
/* @var $ctg frontend\controllers\SiteController */

$thetitle=Yii::t('app','Search Results');
$this->title = $thetitle.' | '.Yii::$app->name;
$this->params['breadcrumbs'][] = $thetitle;


?>
<div class="container">
    <?php
    echo $this->render('_search_form',['ctg'=>$ctg,'queryWord'=>$queryWord]);
    if($page)
        foreach($page as $result)
        {
            $title=preg_replace("/({$queryWord})/iu", "<span class='founded' >$1</span>", $result['title']);
            ?>
            <div class="search-result" >
                <div class="title"><?=Html::a($title, ['/page/view','id'=>$result['id']]);?></div>
                <?php
                $text=StringHelper::truncate($result['content'],50,'...');
                $text=preg_replace("/({$queryWord})/iu", "<span class='founded' >$1</span>", $text);
                echo $text;?>
            </div>
            <?php
        }
    if($article){
        foreach($article as $result)
        {
            $title=preg_replace("/({$queryWord})/iu", "<span class='founded' >$1</span>", $result['title']);
            ?>
            <div class="search-result" >
                <div class="title"><?=Html::a($title, ['/article/view','id'=>$result['id']]);?></div>
                <?php
                $text=StringHelper::truncate($result['text'],50,'...');
                $text=preg_replace("/({$queryWord})/iu", "<span class='founded' >$1</span>", $text);
                echo $text;?>
            </div>
            <?php
        }
    }
    if($event){
        foreach($event as $result)
        {
            $title=preg_replace("/({$queryWord})/iu", "<span class='founded' >$1</span>", $result['title']);
            ?>
            <div class="search-result" >
                <div class="title"><?=Html::a($title, ['/event/view','id'=>$result['id']]);?></div>
                <?php
                $text=StringHelper::truncate($result['text'],50,'...');
                $text=preg_replace("/({$queryWord})/iu", "<span class='founded' >$1</span>", $text);
                echo $text;?>
            </div>
            <?php
        }
    }

    if($expert){
        foreach($expert as $result)
        {
            if($result['image'])
                $img=Html::img("/images/expert/".$result['id']."/s_".$result['image'],['class'=>'round author_image_small']);
            else {
                $words = explode(" ", $result['title']);
                $acronym = "";

                foreach ($words as $w) {
                    $acronym .= mb_substr($w, 0, 1);
                }
                $img="<div class='round initials_thumb'>".$acronym."</div>";
            }
            $url=Html::a($img,['/expert/view','id'=>$result['id']]);

            $title=preg_replace("/({$queryWord})/iu", "<span class='founded' >$1</span>", $result['title']);
            ?>
            <div class="search-result" >
                <div class='pull-left mr15'><?=$url?></div>
                <div class="title"><?=Html::a($title, ['/expert/view','id'=>$result['id']]);?></div>
                <?php
                $text=StringHelper::truncate($result['description'],50,'...');
                $text=preg_replace("/({$queryWord})/iu", "<span class='founded' >$1</span>", $text);
                echo $text;?>
            </div>
            <?php
        }
    }

    if(!$page && !$expert && !$event && !$article)
        echo Yii::t('app','No results found');
    ?>
</div>
