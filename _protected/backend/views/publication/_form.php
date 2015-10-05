<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use mihaildev\ckeditor\CKEditor;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model app\models\Publication */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="publication-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php
    $tabsArray= array();
    $i=0;
    foreach(Yii::$app->params['languages'] as $key=>$lang){
        $tabsArray[$i++]=[
            'label' => $lang,
            'active' => $key==Yii::$app->language?true:false, 
            'content' => $form->field($model, 'title_'.$key)->textInput(['maxlength' => 255,'style'=>'width: 800px;']).
                         $form->field($model, 'summary_'.$key)->widget(CKEditor::className(),['editorOptions' => ['toolbarGroups'=>Yii::$app->params['CKEtoolbarGroups'], 'width'=>'800px'],]).
                         $form->field($model, 'content_'.$key)->widget(CKEditor::className(),['editorOptions' => ['toolbarGroups'=>Yii::$app->params['CKEtoolbarGroups'], 'width'=>'800px'],])
                         
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
                'apiRoute' => 'publication/galleryApi'
            ]
        );
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
