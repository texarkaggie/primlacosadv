<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Service */

$this->title = $model->getAttribute('title_'.Yii::$app->language);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'category.name_'.Yii::$app->language,
            'sku',
            [
                'attribute' => 'promo',
                'value' => $model->promo?Yii::t('app', 'Yes'):Yii::t('app', 'No'),
            ],
            'title_'.Yii::$app->language,
            'summary_'.Yii::$app->language.':ntext',
            'description_'.Yii::$app->language.':ntext',
            'availability_'.Yii::$app->language.':ntext',
            'promo_txt_'.Yii::$app->language.':ntext',
            'price',
            'created_at:dateTime',
            'updated_at:dateTime',
        ],
    ]);
    foreach($model->getBehavior('galleryBehavior')->getImages() as $image){
        echo Html::img($image->getUrl('small'), ['style'=>'padding: 5px;']);
    }
    ?>
</div>
