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
    <title><?= Html::encode($this->title) ?><?php if(\Yii::$app->controller->id == 'site' && \Yii::$app->controller->action->id == 'index') {} else { ?> - <?=Yii::t('app','The China Guide')?><?php } ?></title>
    <meta name="description" content="<?= $this->description ?>" />
    <meta name="keywords" content="<?= $this->keywords ?>" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/statics/images/logo.png', ['alt'=>Yii::t('app','The China Guide')]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $languages_menu = [];
    foreach (Yii::$app->urlManager->languages as $language) {
        $languages_menu[] = ['label' => mb_strtoupper(Yii::$app->params['language_name'][$language],'utf-8'), 'url' => Url::toRoute(['/', 'language'=>$language])];
    }
    $menuItems = [
        ['label' => Yii::t('app','HOME'), 'url' => ['/']],
        ['label' => Yii::t('app','EXPERIENCES'), 'url' => ['/experiences'], 'active' => \Yii::$app->controller->id == 'experience'],
        ['label' => Yii::t('app','DESTINATIONS'), 'url' => ['/destinations'], 'active' => \Yii::$app->controller->id == 'destination'],
        //['label' => 'GROUP', 'active' => (\Yii::$app->controller->id == 'educational-programs' || \Yii::$app->controller->id == 'meetings-incentives'), 'items' =>[['label' => 'EDUCATIONAL PROGRAMS', 'url' => ['/educational-programs'], 'active' => \Yii::$app->controller->id == 'educational-programs'],['label' => 'MEETINGS & INCENTIVES', 'url' => ['/meetings-incentives'], 'active' => \Yii::$app->controller->id == 'meetings-incentives'],]],
        ['label' => Yii::t('app','EDUCATIONAL PROGRAMS'), 'url' => ['/educational-programs'], 'active' => \Yii::$app->controller->id == 'educational-programs'],
        ['label' => mb_strtoupper(Yii::$app->params['language_name'][Yii::$app->language],'utf-8'), 'items'=>$languages_menu],
        ['label' => Yii::t('app','MORE'), 'active' => (\Yii::$app->controller->id == 'article' || \Yii::$app->controller->id == 'faq' || \Yii::$app->controller->id == 'about'), 'items' =>[['label' => Yii::t('app','BLOGS'), 'url' => ['/article/index'], 'active' => \Yii::$app->controller->id == 'article'],
        ['label' => Yii::t('app','FAQ'), 'url' => ['/faq'], 'active' => \Yii::$app->controller->id == 'faq'],
        ['label' => Yii::t('app','ABOUT US'), 'url' => ['/about'], 'active' => \Yii::$app->controller->id == 'about'],]],

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
        <h3><?= Yii::t('app','Navigation') ?></h3>
        <ul class="">
            <li><i class="icon-menu-home"></i><a href="<?= Url::toRoute(['/']) ?>">HOME</a></li>
            <li><i class="icon-menu-experiences"></i><a href="<?= Url::toRoute(['experience/index']) ?>"><?= Yii::t('app','EXPERIENCES') ?></a></li>
            <li><i class="icon-menu-destinations"></i><a href="<?= Url::toRoute(['destination/index']) ?>"><?= Yii::t('app','DESTINATIONS') ?></a></li>
            <li><i class="icon-menu-education"></i><a href="<?= Url::toRoute(['/educational-programs']) ?>"><?= Yii::t('app','EDUCATIONAL PROGRAMS') ?></a></li>
            <!-- <li><i class="icon-menu-mice"></i><a href="<?= Url::toRoute(['/meetings-incentives']) ?>"><?= Yii::t('app','MEETINGS &amp; INCENTIVES') ?></a></li> -->
            <li><i class="icon-menu-articles"></i><a href="<?= Url::toRoute(['article/index']) ?>"><?= Yii::t('app','BLOGS') ?></a></li>
            <li><i class="icon-menu-faq"></i><a href="<?= Url::toRoute(['faq/index']) ?>"><?= Yii::t('app','FAQ') ?></a></li>
            <li><i class="icon-menu-aboutus"></i><a href="<?= Url::toRoute(['/about']) ?>"><?= Yii::t('app','ABOUT US') ?></a></li>
        </ul>
        <h3><?= Yii::t('app','Language') ?></h3>
        <ul class="">
            <?php foreach (Yii::$app->urlManager->languages as $language) { ?>
                <li><i class="icon-menu-<?= Yii::$app->language==$language?'sel':'none' ?>"></i><a href="<?= Url::toRoute(['/', 'language'=>$language]) ?>"><?= Yii::$app->params['language_name'][$language] ?></a></li>
            <?php } ?>
        </ul>
        <h3><?= Yii::t('app','Currency') ?></h3>
        <ul class="">
            <?php foreach (Yii::$app->params['currency_name'] as $ckey => $currency) { ?>
                <li><i class="icon-menu-<?= Yii::$app->params['currency']==$ckey?'sel':'none' ?>"></i><a href="<?= Url::toRoute(['site/currency', 'currency'=>$ckey]) ?>"><?= $currency['sign'] . ' ' . $currency['name'] ?></a></li>
            <?php } ?>
        </ul>
        <span><?=Yii::t('app','The China Guide')?><br /><?= Yii::t('app','A Beijing-based, foreign-owned travel agency.') ?></span>
    </div>
    <div class="container top-ccontainer">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">

    <div class="social-media-icons">
        <center><?=Yii::t('app','FOLLOW US ON')?></center>
        <div id="social-media-icons-container">
            <a href="https://www.tripadvisor.com/Attraction_Review-g294212-d2658278-Reviews-The_China_Guide-Beijing.html" id="tripadvisor" target="_blank"></a>
            <a href="http://www.instagram.com/the_chinaguide" id="instagram" target="_blank"></a>
            <a href="https://www.facebook.com/thechinaguide" id="facebook" target="_blank"></a>
            <a href="http://twitter.com/thechinaguide" id="twitter" target="_blank"></a>
            <a href="http://www.linkedin.com/company/the-china-guide" id="linkedin" target="_blank"></a>
            <a href="http://www.pinterest.com/thechinaguide" id="pinterest" target="_blank"></a>
        </div>
        <center><?=Yii::t('app','QUICK LINKS')?></center>
        <center>
            <a href="<?= Url::toRoute(['experience/index']) . '#form-info-page' ?>"><?=Yii::t('app','Plan a vacation')?></a> | 
            <a href="<?= Url::toRoute(['/educational-programs']) . '#form-info-page' ?>"><?=Yii::t('app','Plan an educational trip')?></a> | 
            <!-- <a href="<?= Url::toRoute(['/meetings-incentives']) . '#form-info-page' ?>"><?=Yii::t('app','Plan an incentive trip')?></a> | --> 
            <a href="<?= Url::toRoute(['about/company-policies']) ?>"><?=Yii::t('app','Company policies')?></a> | 
            <a href="<?= Url::toRoute(['about/contact-us']) ?>"><?=Yii::t('app','Contact us')?></a>
        </center>
    </div>
    <div class="search-box">
        <form id="search-form" method="get" action="http://www.google.com/search" target="_blank">
            <input type="text" name="q" placeholder="<?=Yii::t('app','Powered by Google')?>">
            <input type="hidden" value="http://www.thechinaguide.com" name="sitesearch">
            <button id="search-button" type="submit">                     
                <span><?=Yii::t('app','SEARCH')?></span>
            </button>
        </form>
    </div>
    <div class="pata">
        <?= Html::img('@web/statics/images/PATA.jpg', ['alt'=>'PATA member']) ?>
    </div>
    <div class="copyright">
        <p>&copy; 2008 - <?= date('Y') ?> <?=Yii::t('app','The China Guide')?></p>
    </div>
        

        <p class="pull-right"><?//= Yii::powered() ?></p>
    </div>
</footer>
<div id="gotop"><i class="glyphicon glyphicon-chevron-up"></i><br /><?=Yii::t('app','TOP')?></div>
<?php $this->endBody() ?>
<?php
$js = <<<JS
    $(function(){
        $('.navbar-toggle').attr('id', 'bt_toggle');
        $('.navbar-toggle').click(function(){
            $('body,html').animate({scrollTop:0},0);
            $('.navbar-collapse.collapse').hide();
            if($('.m-menu').is(":visible")){
                $('.m-menu').hide();
            }
            else{
                $('.m-menu').show();
            }
        });
        $('#gotop').click(function(){
            $('body,html').animate({scrollTop:0},1000);
        });
        $(window).scroll(function(e) {
        if($(window).scrollTop()>100)
            $("#gotop").fadeIn(1000);
        else
            $("#gotop").fadeOut(1000);
        });

        $('.carousel').carousel({
            interval: 4000
        })
        $('.carousel').hammer().on('swipeleft', function(){  
            $(this).carousel('next');  
        });  
        $('.carousel').hammer().on('swiperight', function(){  
            $(this).carousel('prev');  
        }); 
    });
JS;
$this->registerJs($js);
?>
</body>
</html>
<?php $this->endPage() ?>
