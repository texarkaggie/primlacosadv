<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="box1">
    <a style="text-decoration: none;" href="<?= Url::to(['view', 'id' => $model->id])?>">
        <?php     
        foreach($model->getBehavior('galleryBehavior')->getImages() as $image) {
            echo Html::img($image->getUrl('original'),['style'=>'width: 100%;']);
            break;
        }
        if(!$model->getBehavior('galleryBehavior')->getImages())
            echo Html::img('@web/uploads/images/noimage.png', ['style'=>'width: 100%; border: 0 none; vertical-align: top;']);
        ?>
        <div class="team-content">
            <p class="team-name"><?= $model->name?></p>
            <p class="team-role"><?= $model->getAttribute('role_'.Yii::$app->language)?></p>
        </div>
    </a>
</div>
