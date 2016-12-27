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
        ['label' => 'HOME', 'url' => ['/']],
        ['label' => 'EXPERIENCES', 'url' => ['/experiences'], 'active' => \Yii::$app->controller->id == 'experience'],
        ['label' => 'DESTINATIONS', 'url' => ['/destinations'], 'active' => \Yii::$app->controller->id == 'destination'],
        //['label' => 'GROUP', 'active' => (\Yii::$app->controller->id == 'educational-programs' || \Yii::$app->controller->id == 'meetings-incentives'), 'items' =>[['label' => 'EDUCATIONAL PROGRAMS', 'url' => ['/educational-programs'], 'active' => \Yii::$app->controller->id == 'educational-programs'],['label' => 'MEETINGS & INCENTIVES', 'url' => ['/meetings-incentives'], 'active' => \Yii::$app->controller->id == 'meetings-incentives'],]],
        ['label' => 'EDUCATIONAL PROGRAMS', 'url' => ['/educational-programs'], 'active' => \Yii::$app->controller->id == 'educational-programs'],
        ['label' => 'MORE', 'active' => (\Yii::$app->controller->id == 'article' || \Yii::$app->controller->id == 'faq' || \Yii::$app->controller->id == 'about'), 'items' =>[['label' => 'BLOGS', 'url' => ['/article/index'], 'active' => \Yii::$app->controller->id == 'article'],
        ['label' => 'FAQ', 'url' => ['/faq'], 'active' => \Yii::$app->controller->id == 'faq'],
        ['label' => 'ABOUT US', 'url' => ['/about'], 'active' => \Yii::$app->controller->id == 'about'],]],
        

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
            <li><i class="icon-menu-education"></i><a href="<?= Url::toRoute(['/educational-programs']) ?>">EDUCATIONAL PROGRAMS</a></li>
            <!-- <li><i class="icon-menu-mice"></i><a href="<?= Url::toRoute(['/meetings-incentives']) ?>">MEETINGS &amp; INCENTIVES</a></li> -->
            <li><i class="icon-menu-articles"></i><a href="<?= Url::toRoute(['article/index']) ?>">BLOGS</a></li>
            <li><i class="icon-menu-faq"></i><a href="<?= Url::toRoute(['faq/index']) ?>">FAQ</a></li>
            <li><i class="icon-menu-aboutus"></i><a href="<?= Url::toRoute(['/about']) ?>">ABOUT US</a></li>
        </ul>
        <h3>Language</h3>
        <ul class="">
            <?php foreach (Yii::$app->urlManager->languages as $language) { ?>
                <li><i class="icon-menu-<?= Yii::$app->language==$language?'sel':'none' ?>"></i><a href="<?= Url::toRoute(['/', 'language'=>$language]) ?>"><?= Yii::$app->params['language_name'][$language] ?></a></li>
            <?php } ?>
        </ul>
        <h3>Currency</h3>
        <ul class="">
            <?php foreach (Yii::$app->params['currency_name'] as $ckey => $currency) { ?>
                <li><i class="icon-menu-<?= Yii::$app->params['currency']==$ckey?'sel':'none' ?>"></i><a href="<?= Url::toRoute(['site/currency', 'currency'=>$ckey]) ?>"><?= $currency['name'] ?></a></li>
            <?php } ?>
        </ul>
        <span>The China Guide<br />A Beijing-based, foreign-owned travel agency.</span>
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
        <center>FOLLOW US ON</center>
        <div id="social-media-icons-container">
            <a href="https://www.tripadvisor.com/Attraction_Review-g294212-d2658278-Reviews-The_China_Guide-Beijing.html" id="tripadvisor" target="_blank"></a>
            <a href="http://www.instagram.com/the_chinaguide" id="instagram" target="_blank"></a>
            <a href="https://www.facebook.com/thechinaguide" id="facebook" target="_blank"></a>
            <a href="http://twitter.com/thechinaguide" id="twitter" target="_blank"></a>
            <a href="http://www.linkedin.com/company/the-china-guide" id="linkedin" target="_blank"></a>
            <a href="http://www.pinterest.com/thechinaguide" id="pinterest" target="_blank"></a>
        </div>
        <center>QUICK LINKS</center>
        <center>
            <a href="<?= Url::toRoute(['experience/index']) . '#form-info-page' ?>">Plan a vacation</a> | 
            <a href="<?= Url::toRoute(['/educational-programs']) . '#form-info-page' ?>">Plan an educational trip</a> | 
            <!-- <a href="<?= Url::toRoute(['/meetings-incentives']) . '#form-info-page' ?>">Plan an incentive trip</a> | --> 
            <a href="<?= Url::toRoute(['about/company-policies']) ?>">Company policies</a> | 
            <a href="<?= Url::toRoute(['about/contact-us']) ?>">Contact us</a>
        </center>
    </div>
    <div class="search-box">
        <form id="search-form" method="get" action="http://www.google.com/search" target="_blank">
            <input type="text" name="q" placeholder="Powered by Google">
            <input type="hidden" value="http://www.thechinaguide.com" name="sitesearch">
            <button id="search-button" type="submit">                     
                <span>SEARCH</span>
            </button>
        </form>
    </div>
    <div class="pata">
        <?= Html::img('@web/statics/images/PATA.jpg', ['alt'=>'PATA member']) ?>
    </div>
    <div class="copyright">
        <p>&copy; 2008 - <?= date('Y') ?> The China Guide</p>
    </div>
        

        <p class="pull-right"><?//= Yii::powered() ?></p>
    </div>
</footer>
<div id="gotop"><i class="glyphicon glyphicon-chevron-up"></i><br />TOP</div>
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
