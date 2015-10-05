<?php
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3"></script>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => null,
                'brandUrl' => null,
                'options' => [
                    'class' => 'navbar-default isStuck',
                    //'id' => 'stuck_container',
                ],
            ]);

            // everyone can see Home page
            $menuItems[] = ['label' => Yii::t('app', 'HOME'), 'url' => ['/site/index']];
            
            $menuItems[] = ['label' => Yii::t('app', 'SERVICES'), 'url' => ['/service/index']];
            
            if (Yii::$app->user->can('admin')) {
                $menuItems[] = ['label' => Yii::t('app', 'PUBLICATIONS'), 'url' => ['/publication/index']];
                $menuItems[] = ['label' => Yii::t('app', 'PARTNERSHIPS'), 'url' => ['/partner/index']];
                $menuItems[] = ['label' => Yii::t('app', 'ABOUT US'), 'items' =>  [
                                    ['label' => Yii::t('app', 'INFO'), 'url' => ['/about/view', 'id' => 1]],
                                    ['label' => Yii::t('app', 'GALLERY'), 'url' => ['/gallery/view', 'id' => 1]],
                                    ['label' => Yii::t('app', 'TEAM'), 'url' => ['/team/index']],
                ]];
            }
            
            $menuItems[] = ['label' => Yii::t('app', 'CONTACTS'), 'url' => ['/contact/index']];
            
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>
        
        <?php if(Url::current()== Url::home().'site/index'){?>          
        <div class="wow animated fadeIn" style="border-bottom-left-radius: 50% 46px; border-bottom-right-radius: 50% 46px; overflow: hidden;">
                <?= Html::img('@web/uploads/images/slide02.jpg', ['style'=>'width: 100%;']); ?>
            </div>
        <?php } ?>
        <div class="breadcrumb-bar">
            <div class="container">
                <?= Breadcrumbs::widget([
                    'homeLink'=>['label' => Yii::t('app', 'Home'), 'url' => ['site/index']],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
            </div>
        </div>
        <div class="wrap">
            <?= $content ?>
        </div>
    </div>

    <?php if(Url::current()== Url::home().'contact/index'){?>    
        <footer class="contact-footer wow animated fadeInUp">
    <?php }else{ ?>    
        <footer class="footer wow animated fadeInUp">
    <?php }?>        
        <div class="container">
            <div class="inner-container">    
               <?php /*
                    <ul class="socail-ftr">                        
                        <li><?= Html::a('', 'https://www.facebook.com/primeiroslacos', ['target'=>'_blank', 'class'=>'facebook'])?></li>
                        <li><?= Html::a('', 'https://www.twitter.com/primeiroslacos', ['target'=>'_blank', 'class'=>'twitter'])?></li>
                        <li><?= Html::a('', 'https://www.google.com/primeiroslacos', ['target'=>'_blank', 'class'=>'googleplus'])?></li>
                    </ul>
                */?>
                <p class="pull-center">&nbsp;</p>
                <p class="pull-right">&copy; <?= Yii::t('app', Yii::$app->name) ?> <?= date('Y') ?></p>
                <div class="clearfix"></div>
            </div>    
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
