<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contacts');
?>
<style>
    #googlemaps {
        height:80%;width:100%;position:absolute;left:0;z-index:0;opacity:.75;
    } 
    .contact-index {
        z-index: 9;
        position: relative;
        margin-top: 30px;
        background-color: rgba(255, 255, 255, 0.7);

    } 
</style>
<div id="googlemaps"></div>
<div class="container">
    <div class="contact-index">
        <div style="width: 50%; float: left; color: #000000;">
            <div style="padding: 20px;">
                    <?= newerton\fancybox\FancyBox::widget([
                        'target' => 'a[rel=fancybox]',
                        'helpers' => false,
                        'mouse' => true,
                    ]);                 
                    foreach($model->getBehavior('galleryBehavior')->getImages() as $image) {
                        echo Html::a(Html::img($image->getUrl('original'), ['style'=>'width: 70%;']), $image->getUrl('original'), ['rel'=>'fancybox']);
                        break;
                    }
                    ?>
            </div>
        </div>
        <div style="width: 50%; float: left; color: #000000;">
            <h2><?php echo Yii::t('app', 'Contacts');?></h2>
            <p style="line-height: 20pt;">
                <b style="font-size: 13pt"><?= $model->company?></b><br />
                <?= $model->address?><br />
                <?= $model->postal.' '.$model->city?><br />
                <b><?= Yii::t('app', 'Phone').': '?></b><?= $model->phone?><br />
                <b><?= Yii::t('app', 'Email').': '?></b><a href="mailto:<?= $model->email?>"><?= $model->email?></a><br />
                <b><?= Yii::t('app', 'GPS Coordinates').': '?></b><?= $model->lat.' , '.$model->lng?>
            </p>
            <div style="margin-top: 5%; padding-bottom: 5%;">
                <?= Html::button(Yii::t('app', 'Send message'), ['value'=> Url::to('contact'), 'id'=>'modalButton', 'class'=>'btn btn-success', 'style'=>'background-color: #ff6d72;'])?>
                <?php
                Modal::begin([
                    'header' => '<h2>'.Yii::t('app', 'Contact Form').'</h2>',
                    'id' => 'modal',
                    //'size' => 'modal-lg',
                    //'toggleButton' => ['label' => Yii::t('app', 'Send message')],
                    'clientOptions' => [
                            'backdrop' => 'static',
                            'keyboard' => false,
                        ],
                ]);
                echo '<div id="modalContent"></div>';
                Modal::end();
                ?>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
</div>    
<script type="text/javascript"> 
    // The latitude and longitude of your business / place
    var position = [40.112898, -8.494118];
    var centerPosition = [40.114898, -8.494118];
    
    function showGoogleMaps() {
        var latLng = new google.maps.LatLng(position[0], position[1]);
        var latLngCenter = new google.maps.LatLng(centerPosition[0], centerPosition[1]);
        var mapOptions = {
            zoom: 16, // initialize zoom level - the max value is 21
            streetViewControl: false, // hide the yellow Street View pegman
            scaleControl: true, // allow users to zoom the Google Map
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: latLngCenter
        };

        map = new google.maps.Map(document.getElementById('googlemaps'),mapOptions);

        // Show the default red marker at the location
        marker = new google.maps.Marker({
        position: latLng,
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP
        });
    } 
    google.maps.event.addDomListener(window, 'load', showGoogleMaps);
</script>