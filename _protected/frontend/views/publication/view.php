<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Publication */

$this->title = $model->getAttribute('title_'.Yii::$app->language);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Publications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="publication-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'title_en',
                'title_pt:ntext',
                'summary_en:ntext',
                'summary_pt:ntext',
                'content_en:ntext',
                'content_pt:ntext',
                'created_at',
                'updated_at',
            ],
        ]) ?>

    </div>
</div>