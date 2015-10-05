<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Team');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Team'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'role_'.Yii::$app->language,
            'intro_'.Yii::$app->language.':ntext',
            // 'intro_pt:ntext',
            // 'created_at',
            [
                'attribute' => 'updated_at',             
                'value' => 'updated_at',
                'format' => 'dateTime',
                'options' => ['class' => 'tripleSizeColumn'],                              
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
