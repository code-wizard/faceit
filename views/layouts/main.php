<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="faceit">
<head >
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <script src="https://use.fontawesome.com/356170ce38.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script>
        var baseUrl = "<?=Url::base();?>"
    </script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Faceit',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            // ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Faceit <?= date('Y') ?></p>

        
    </div>
</footer>
    <?php $this->registerJsFile('https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <?php  $this->registerJsFile( Url::base().'/js/app.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <?php $this->registerJsFile( Url::base().'/js/dirPagination/dirPagination.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <?php $this->registerJsFile( Url::base().'/js/faceit.controller.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
