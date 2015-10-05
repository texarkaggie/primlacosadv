<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
$this->title = Yii::t('app', Yii::$app->name);
?>
<div class="container">
    <div class="site-index">
        <div class="body-content">
            <div class="row">
                <div id="stuck_container" class="service-index wow animated fadeInUp isStuck" style="text-align: center;">
                    <div class="row">
                        <?php                        
                        foreach($modelImg->getBehavior('galleryBehavior')->getImages() as $image) {
                            echo Html::img($image->getUrl('original'),['style'=>'width: 70%;']);
                            break;
                        }?>
                    </div>
                    <div class="row">
                        <h3><?= 'Destaques'?></h3>
                        <?= ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemOptions' => ['class' => 'item wow animated fadeIn'],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('_view',['model'=>$model]);
                            },
                            'layout' => "<div class=\"featured-grid\">{items}<div class=\"clearfix\"></div></div>",
                        ]) ?>
                    </div>
                </div>
                <div class="service-menu wow animated fadeInLeft">
                    <?php
                    foreach ($cat as $key => $value) {?>
                        <h3><?= Yii::t('app', $value->getAttribute('name_'.Yii::$app->language)) ?></h3>
                        <?php
                        foreach ($serv as $key1 => $value1) {
                            if($value->id == $value1->category_id){?>
                                <li><?=Html::a($value1->getAttribute('title_'.Yii::$app->language),['service/view', 'id' => $value1->id], ['class'=>'sideLink'])?></li>
                            <?php
                            }
                        }?>              
                     <?php }?>
                    <div style="padding: 20% 5%">        
                        <p style="margin: 10px 0;">Site em construção...</p>
                        <p style="margin: 10px 0;">Prometemos ser breves.</p>
                        <p style="margin: 10px 0;">Até lá pode seguir-nos nas redes sociais</p>
                        <div class="socials">
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="https://www.facebook.com/primeiroslacos" target="_blank"></a>            
                        </div>
                    </div>
                </div>







            </div>
        </div>
    </div>
</div>