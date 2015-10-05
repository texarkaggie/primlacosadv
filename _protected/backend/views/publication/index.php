<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PublicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Publications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Publication'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'options' => ['class' => 'oneSizeColumn'],
            ],

            'title_'.Yii::$app->language,            
            'summary_'.Yii::$app->language.':ntext',
            // 'content_en:ntext',
            // 'content_pt:ntext',
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
