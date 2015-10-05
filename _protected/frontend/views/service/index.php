<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="service-index">
        <div><h1><?= Html::encode($this->title) ?></h1></div>
        <div><p><?= ' ' ?></p></div>

        <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item wow animated fadeIn'],
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_view',['model'=>$model]);
            },
            'layout' => "<div class=\"products-grid\">{items}<div class=\"clearfix\"></div></div>\n{summary}\n{pager}",
        ]) ?>
    </div>
    <div id="stuck_container" class="service-menu animated fadeInLeft isStuck">
        <?php
        foreach ($cat as $key => $value) {?>
            <h3><?= Yii::t('app', $value->getAttribute('name_'.Yii::$app->language)) ?></h3>
            <?php
            foreach ($serv as $key1 => $value1) {
                if($value->id == $value1->category_id){?>
                    <li><?=Html::a($value1->getAttribute('title_'.Yii::$app->language),['view', 'id' => $value1->id], ['class'=>'sideLink'])?></li>
                <?php
                }
            }?>              
         <?php }?>
    </div>
</div>
<?php/* \pavlinter\wow\WowAsset::register($this)->wow([
    'boxClass' => 'wow',
    'animateClass' => 'animated',
    'offset' => '0',
]);
echo Html::tag("div", "Your content or images.", ['class' => 'wow bounceInUp']);*/
?>