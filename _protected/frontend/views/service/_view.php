<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="itemcontainer"> 
    <a class="listLink" href="<?= Url::to(['view', 'id' => $model->id])?>">        
        <div class="list-img">
            <?php     
            foreach($model->getBehavior('galleryBehavior')->getImages() as $image) {
                echo Html::img($image->getUrl('original'),['style'=>'width: 100%;']);
                break;
            }
            if(!$model->getBehavior('galleryBehavior')->getImages())
                echo Html::img('@web/uploads/images/noimage.png', ['style'=>'max-width: 100%; border: 0 none; vertical-align: top;']);
            ?>
        </div>
        <p><?= $model->getAttribute('title_'.Yii::$app->language)?></p>
    </a>
</div>
