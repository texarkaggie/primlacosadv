<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            'company',
            'address',
            'city',
            'postal',
            'phone',
            'email:email',
            'lat',
            'lng',
        ],
    ]);

    foreach($model->getBehavior('galleryBehavior')->getImages() as $image){
        echo Html::img($image->getUrl('small'), ['style'=>'padding: 5px;']);
    }
    ?>
</div>
