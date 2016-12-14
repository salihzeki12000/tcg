<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/statics/images/logo.png', ['alt'=>Yii::t('common','The China Guide')]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Experiences', 'url' => ['/experiences'], 'active' => \Yii::$app->controller->id == 'experience'],
        ['label' => 'Destinations', 'url' => ['/destinations'], 'active' => \Yii::$app->controller->id == 'destination'],
        ['label' => 'Articles', 'url' => ['/articles'], 'active' => \Yii::$app->controller->id == 'article'],
        ['label' => 'FAQ', 'url' => ['/faq'], 'active' => \Yii::$app->controller->id == 'faq'],
        // ['label' => 'About', 'url' => ['/site/about']],
        // ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        // $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        // $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="m-menu">
        <h3>Navigation</h3>
        <ul class="">
            <li><i class="icon-menu-home"></i><a href="<?= Url::toRoute(['/']) ?>">HOME</a></li>
            <li><i class="icon-menu-experiences"></i><a href="<?= Url::toRoute(['experience/index']) ?>">EXPERIENCES</a></li>
            <li><i class="icon-menu-destinations"></i><a href="<?= Url::toRoute(['destination/index']) ?>">DESTINATIONS</a></li>
            <li><i class="icon-menu-education"></i><a href="<?= Url::toRoute(['article/view', 'name'=>'educational programs']) ?>">EDUCATIONAL PROGRAMS</a></li>
            <li><i class="icon-menu-mice"></i><a href="<?= Url::toRoute(['articles/view', 'name'=>'meetings & incentives']) ?>">MEETINGS &amp; INCENTIVES</a></li>
            <li><i class="icon-menu-articles"></i><a href="<?= Url::toRoute(['article/index']) ?>">ARTICLES</a></li>
            <li><i class="icon-menu-faq"></i><a href="<?= Url::toRoute(['faq/index']) ?>">FAQ</a></li>
            <li><i class="icon-menu-aboutus"></i><a href="<?= Url::toRoute(['article/view', 'name'=>'about us']) ?>">ABOUT US</a></li>
        </ul>
        <span>The China Guide<br />A Beijing-based, foreign-owned travel agency.</span>
    </div>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; The China Guide <?= date('Y') ?></p>

        <p class="pull-right"><?//= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<?php
$js = <<<JS
    $('.navbar-toggle').attr('id', 'bt_toggle');
    $('.navbar-toggle').click(function(){
        $('.navbar-collapse.collapse').hide();
        if($('.m-menu').is(":visible")){
            $('.m-menu').hide();
        }
        else{
            $('.m-menu').show();
        }
    });
JS;
$this->registerJs($js);
?>
</body>
</html>
<?php $this->endPage() ?>
