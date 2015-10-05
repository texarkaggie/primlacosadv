<?php

use yii\helpers\Html;
use bupy7\flexslider\FlexSlider;

/* @var $this yii\web\View */
/* @var $model app\models\Team */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Team'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$img = []; $i=0;
foreach($model->getBehavior('galleryBehavior')->getImages() as $image) {
    $img[$i++]= Html::a(Html::img($image->getUrl('original')), $image->getUrl('original'), ['rel'=>'fancybox']);
}
if($i==0){
    $img[$i++]= Html::a(Html::img('@web/uploads/images/noimage.png', ['style'=>'max-width: 100%; border: 0 none; vertical-align: top;']), '@web/uploads/images/noimage.png', ['rel'=>'fancybox']);
}
?>
<div class="container">
    <div class="team-view">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="about-img-div col-lg-4">
            <div class="img-box">
                    <?= newerton\fancybox\FancyBox::widget([
                        'target' => 'a[rel=fancybox]',
                        'helpers' => false,
                        'mouse' => true,
                    ]);?>
                    <?= FlexSlider::widget([
                        'items' => $img,
                        'pluginOptions'=>['animation'=>'slide', 'controlNav'=>false, 'animationLoop'=>true, 'slideshow'=>true],
                        'options'=>['class'=>'flexslider'],
                        ]);                    
                    ?>                

            </div>
        </div>
        <div class="about-info col-lg-7">        
            <?= $model->getAttribute('role_'.Yii::$app->language)?>

            <?= $model->getAttribute('intro_'.Yii::$app->language)?>

        </div>
    </div>
</div>
