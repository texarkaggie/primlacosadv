<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Gallery */

$this->title = $model->getAttribute('title_'.Yii::$app->language);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="gallery-view">
        <div class="header">
            <h1><?= Html::encode($this->title) ?></h1>
            <?= $model->getAttribute('summary_'.Yii::$app->language)?>
        </div>
        <?= newerton\fancybox\FancyBox::widget([
            'target' => 'a[class=fancybox]',
            'helpers' => false,
            'mouse' => true,
            'config' => [
                'openEffect' => 'elastic',
                'closeEffect' => 'elastic',
                'prevEffect' => 'elastic',
                'nextEffect' => 'elastic',
            ],
        ]);
        foreach($model->getBehavior('galleryBehavior')->getImages() as $image) {?>
            <div class="gallery-img">
                <?= Html::a(Html::img($image->getUrl('original'),['style'=>'width: 100%;']), $image->getUrl('original'), ['class'=>'fancybox', 'rel'=>'gallery']);?>
            </div>
        <?php    
        }
        ?>
    </div>
</div>