<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
use app\models\Category;
use mihaildev\ckeditor\CKEditor;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model app\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="service-head">
        <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name_'.Yii::$app->language), ['style'=>'width: 300px;', 'prompt' => '('.Yii::t('app','Select a Category').')']) ?>

        <?= $form->field($model, 'sku')->textInput(['maxlength' => true, 'style'=>'width: 150px;']) ?>

        <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'style'=>'width: 150px;']) ?>
        
        <?= $form->field($model, 'promo')->radioList([Yii::t('app','No'), Yii::t('app','Yes')])?>
        
        <div class="clearfix"></div>
    </div>
    <?php
    $tabsArray= array();
    $i=0;    
    foreach(Yii::$app->params['languages'] as $key=>$lang){
        $tabsArray[$i++]=[
            'label' => $lang,
            'active' => $key==Yii::$app->language?true:false, 
            'content' => $form->field($model, 'title_'.$key)->textInput(['maxlength' => 255,'style'=>'width: 800px;']).
                         $form->field($model, 'summary_'.$key)->widget(CKEditor::className(),['editorOptions' => ['toolbarGroups'=>Yii::$app->params['CKEtoolbarGroups'],'width'=>'800px'],]).
                         $form->field($model, 'description_'.$key)->widget(CKEditor::className(),['editorOptions' => ['toolbarGroups'=>Yii::$app->params['CKEtoolbarGroups'],'width'=>'800px'],]).
                         $form->field($model, 'availability_'.$key)->widget(CKEditor::className(),['editorOptions' => ['toolbarGroups'=>Yii::$app->params['CKEtoolbarGroups'],'width'=>'800px'],]).
                         $form->field($model, 'promo_txt_'.$key)->widget(CKEditor::className(),['editorOptions' => ['toolbarGroups'=>Yii::$app->params['CKEtoolbarGroups'],'width'=>'800px'],])
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
                'apiRoute' => 'service/galleryApi'
            ]
        );
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
