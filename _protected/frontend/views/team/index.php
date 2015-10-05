<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Team');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-index">
    <div class="header">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="container">
            <p>A nossa equipa é composta por um conjunto de elementos de diversa áreas, o que nos permite dar resposta às necessidades das famílias de forma singular, extremamente próxima e por isso muito individualiza.</p>
        </div>
    </div>
    <div class="row">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item-team'],
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_view',['model'=>$model]);
            },
            'layout' => "<div class=\"team-grid container\">{items}<div class=\"clearfix\"></div></div>",        
        ]) ?>
    </div>
</div>
