<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\About */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'About'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-view">
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
            'name_'.yii::$app->language,
            'intro_'.yii::$app->language.':ntext',
            'content_'.yii::$app->language.':ntext',
            'created_at:dateTime',
            'updated_at:dateTime',
        ],
    ]);

    foreach($model->getBehavior('galleryBehavior')->getImages() as $image){
        echo Html::img($image->getUrl('small'), ['style'=>'padding: 5px;']);
    }
    ?>
</div>
