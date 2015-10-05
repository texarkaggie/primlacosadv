<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Partners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Partner'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'options' => ['class' => 'oneSizeColumn'],
            ],

            'name',
            'summary_en:ntext',
            'summary_pt:ntext',
            'description_en:ntext',
            // 'description_pt:ntext',
            // 'link',
            // 'created_at',
            [
                'attribute' => 'updated_at',             
                'value' => 'updated_at',
                'format' => 'dateTime',
                'options' => ['class' => 'tripleSizeColumn'],                           
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['class' => 'doubleSizeColumn'],
            ],
        ],
    ]); ?>

</div>
