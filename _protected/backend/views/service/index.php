<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\helpers\CustomHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Service'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'options' => ['class' => 'oneSizeColumn'],
            ],
            [
                'attribute' => 'catName',
                'value' => 'category.name_'.Yii::$app->language, 
                'filter' => ArrayHelper::map($cat, 'name_'.Yii::$app->language, 'name_'.Yii::$app->language),
                //'options' => ['style' => 'width: 10%;'],
            ],
            //['attribute' => 'sku','options' => ['class' => 'tripleSizeColumn'],],            
            'title_'.Yii::$app->language,            
             'summary_'.Yii::$app->language.':ntext',
            // 'summary_pt:ntext',
            // 'description_en:ntext',
            // 'description_pt:ntext',
            // 'availability_en:ntext',
            // 'availability_pt:ntext',
            // 'price',
            [
                'attribute' => 'promo',
                'value' => function($model) {
                    return $model->promo?Yii::t('app', 'Yes'):Yii::t('app', 'No');
                },
                'filter' => ArrayHelper::map(CustomHelper::yesOrNo(), 'id', 'name'),
            ],
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
