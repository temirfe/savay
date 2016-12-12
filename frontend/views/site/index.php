<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
//$this->title = 'Центр политико-правовых исследований';
$this->title = 'ЦППИ';
?>
<div class='slider'><?=Html::img("images/bg_sunset.jpg")?></div>
<div class="site-index container">

    <div class="body-content">

        <h3>Special offers</h3>
        <div class="row">
            <?php
            /*foreach($packages as $pack){
                */?><!--
                <div class="col-md-4 rel img_pack_box">
                    <div class="img_pack_wrap">
                        <?php
/*                        $img=Html::img("/images/package/".$pack['id']."/s_".$pack['image'],['class'=>'img-responsive']);
                        echo "<div class=''>".Html::a($img,['package/view','id'=>$pack['id']])."</div>";
                        */?>

                        <div class="img_pack_title pad15">
                            <h4 class="mt0 mb2">
                                <?/*=Html::a($pack['title']."<span class='false_link'></span>",['package/view','id'=>$pack['id']],['class'=>'no_underline black']);*/?>
                            </h4>
                            <div class="img_pack_text"><?/*=$pack['description'];*/?></div>
                        </div>
                            
                    </div>
                </div>
                --><?php
/*            }*/
            ?>
        </div>

        <br />
        <h3>Explore <span class="highlight gold">POLITICS</span> with us</h3>
        <div class="row">
            <?php
            /*foreach($cities as $city){
                */?><!--
                <div class="col-sm-3 rel img_thumb_box">
                    <div class="photo_thumb">
                        <?php
/*                        $img=Html::img("/images/city/".$city['id']."/s_".$city['image'],['class'=>'img-responsive']);
                        echo Html::a($img,['city/view','id'=>$city['id']]);
                        */?>
                    </div>

                    <div class="abs img_title"><span><?/*=Html::a($city['title']."<div class='false_link'></div>",['city/view','id'=>$city['id']],['class'=>'no_underline']);*/?></span></div>
                </div>
                --><?php
/*            }*/
            ?>
        </div>

    </div>
</div>
