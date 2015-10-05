<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\galleryManager\GalleryManager;
use yii\bootstrap\Tabs;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Team */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="team-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?php
    $tabsArray= array();
    $i=0;    
    foreach(Yii::$app->params['languages'] as $key=>$lang){
        $tabsArray[$i++]=[
            'label' => $lang,
            'active' => $key==Yii::$app->language?true:false, 
            'content' => $form->field($model, 'role_'.$key)->textInput(['maxlength' => true]).
                         $form->field($model, 'intro_'.$key)->widget(CKEditor::className(),['editorOptions' => ['toolbarGroups'=>Yii::$app->params['CKEtoolbarGroups'],'width'=>'800px'],'containerOptions'=>[],])
                ,
            
        ];
    }
    ?>
    <?= Tabs::widget(['items' => $tabsArray])?>

    <?php
    if ($model->isNewRecord) {
        echo 'Can not upload images for new record';
    } else {
        echo GalleryManager::widget(
            [
                'model' => $model,
                'behaviorName' => 'galleryBehavior',
                'apiRoute' => 'team/galleryApi'
            ]
        );
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
