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
    <meta name="theme-color" content="#4D423C">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | <?=Yii::t('app','The China Guide')?></title>
    <meta name="description" content="<?= $this->description ?>" />
    <meta name="keywords" content="<?= $this->keywords ?>" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php if(!YII_DEBUG && \Yii::$app->controller->id != 'form-card') { ?>
<?= $this->render('analyticstracking', []) ?>
<?php } ?>
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
        $languages_menu[] = ['language'=>$language, 'label' => Yii::$app->params['language_name'][$language], 'url' => Url::toRoute([\common\models\Tools::getCurrentUrl(), 'language'=>$language])];
    }
    foreach (Yii::$app->params['currency_name'] as $currency_item){
        $currency_menu[] = ['sign'=>$currency_item['sign'], 'label' => $currency_item['name'], 'url' => Url::toRoute([\common\models\Tools::getCurrentUrl(), 'currency'=> $currency_item['name']])];
    }
    $themes_menu = [];
    if( ($menu_themes = \common\models\Tools::getAllTheme() )!== null){
        foreach ($menu_themes as $theme) {
            $themes_menu[] = ['label' => $theme['name'], 'url' => Url::toRoute(['experience/index', 'theme'=>$theme['url_id']]), 'active' => (\Yii::$app->controller->id == 'experience' && \Yii::$app->controller->action->id == 'index' && Yii::$app->request->get('theme') == $theme['url_id']),];
        }
    }
    $cities_popular_menu = [];
    if( ($menu_cities = \common\models\Tools::getCitiesByRecType(REC_TYPE_POPULAR) )!== null){
        foreach ($menu_cities as $city_item) {
            $cities_popular_menu[] = ['label' => $city_item['name'], 'url' => Url::toRoute(['destination/view', 'url_id'=>$city_item['url_id']]), 'active' => (\Yii::$app->controller->id == 'destination' && \Yii::$app->controller->action->id == 'view' && Yii::$app->request->get('url_id') == $city_item['url_id']),];
        }
    }
    $cities_beaten_menu = [];
    if( ($menu_cities = \common\models\Tools::getCitiesByRecType(REC_TYPE_OFF_THE_BEATEN_TRACK) )!== null){
        foreach ($menu_cities as $city_item) {
            $cities_beaten_menu[] = ['label' => $city_item['name'], 'url' => Url::toRoute(['destination/view', 'url_id'=>$city_item['url_id']]), 'active' => (\Yii::$app->controller->id == 'destination' && \Yii::$app->controller->action->id == 'view' && Yii::$app->request->get('url_id') == $city_item['url_id']),];
        }
    }
    $menuItems = [
        ['label' => Yii::t('app','FIND A TOUR'), 'url' => ['experience/search'], 'active' => (\Yii::$app->controller->id == 'experience' && \Yii::$app->controller->action->id == 'search')],
        ['label' => Yii::t('app','PRIVATE TOURS'), 'items'=>$themes_menu, 'active' => (\Yii::$app->controller->id == 'experience' && \Yii::$app->controller->action->id == 'index')],
        ['label' => Yii::t('app','GROUP TRAVEL'), 'active' => (\Yii::$app->controller->id == 'join-a-group' || \Yii::$app->controller->id == 'educational-programs' || \Yii::$app->controller->id == 'mice'), 'items' => [
            ['label' => Yii::t('app','Student Tour'), 'url' => ['/educational-programs'], 'active' => \Yii::$app->controller->id == 'educational-programs'],
            ['label' => Yii::t('app','MICE Travel'), 'url' => ['/mice'], 'active' => \Yii::$app->controller->id == 'mice'],
        ]],
        ['label' => Yii::t('app','DESTINATIONS'), 'active' => \Yii::$app->controller->id == 'destination',
            'items' => [
            [
                'label' => Yii::t('app','Popular Travel Destinations'),
                'active' => false, 
                'items' => $cities_popular_menu,
                'submenuOptions' => ['class' => 'dropdown-menu'],
            ],
            [
                'label' => Yii::t('app','Off the Beaten Track'),
                'active' => false, 
                'items' => $cities_beaten_menu,
                'submenuOptions' => ['class' => 'dropdown-menu'],
            ],
            [
                'label' => Yii::t('app','All Destinations'),
                'url' => ['destination/index'],
                'active' => false,
            ],
        ]],
        ['label' => Yii::t('app','BLOG'), 'url' => ['/article/index'], 'active' => (\Yii::$app->controller->id == 'article')],
        ['label' => Yii::t('app','ABOUT US'), 'active' => \Yii::$app->controller->id == 'about-us', 'items' => [
            ['label' => Yii::t('app','Who We Are'), 'url' => ['/about-us'], 'active' => (\Yii::$app->controller->id == 'about-us' && \Yii::$app->controller->action->id == 'index')],
            ['label' => Yii::t('app','Meet our team'), 'url' => ['about-us/meet-our-team'], 'active' => (\Yii::$app->controller->id == 'about-us' && \Yii::$app->controller->action->id == 'about-us/meet-our-team')],
            ['label' => Yii::t('app','Our guides'), 'url' => ['about-us/our-guides'], 'active' => (\Yii::$app->controller->id == 'about-us' && \Yii::$app->controller->action->id == 'our-guides')],
            ['label' => Yii::t('app','Drivers & Vehicles'), 'url' => ['about-us/drivers-and-vehicles'], 'active' => (\Yii::$app->controller->id == 'about-us' && \Yii::$app->controller->action->id == 'drivers-and-vehicles')],
            ['label' => Yii::t('app','Contact us'), 'url' => ['about-us/contact-us'], 'active' => (\Yii::$app->controller->id == 'about-us' && \Yii::$app->controller->action->id == 'contact-us')],
            '<li class="divider"></li>',
            '<li class="dropdown-header">Call Us</li>',
            '<li class="dropdown-header">CN: +8610  8532 1860</li>',
            '<li class="dropdown-header">US: +1 646 863 7038</li>',
            '<li class="dropdown-header">AU: +61 871001399</li>',
            '<li class="dropdown-header">UK: +44 203 807 0401</li>',
        ]],
        ['label' => Yii::t('app','MORE'), 'active' => (\Yii::$app->controller->id == 'preparation' || \Yii::$app->controller->id == 'faq'), 'items' =>[
        ['label' => Yii::t('app','Preparation'), 'url' => ['/preparation'], 'active' => \Yii::$app->controller->id == 'preparation'],
        ['label' => Yii::t('app','FAQ'), 'url' => ['/faq'], 'active' => \Yii::$app->controller->id == 'faq'],]]
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

    $p_menu = '<div class="p-menu">
            <i></i>
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="p-menu-search" data-toggle="dropdown"><span class="glyphicon glyphicon-search"></span></button>
              <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="p-menu-search" style="background-color: white">
              <li class="p-menu-search"><form id="search-form" method="get" action="https://www.google.com/search" target="_blank">
            <input type="text" name="q" placeholder="'.Yii::t('app','Search').'">
            <input type="hidden" value="www.thechinaguide.com" name="sitesearch" />
            </form>
            </li>';
    $p_menu .= '</ul></div>
            <div class="dropdown" style="padding-right: 10px">
              <button class="btn btn-default dropdown-toggle" type="button" id="p-menu-setting" data-toggle="dropdown"><span class="glyphicon glyphicon-globe"></span></button>
              <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="p-menu-setting">
                <li role="presentation" class="dropdown-header">'. Yii::t('app','Language') .'</li>';
                    foreach ($languages_menu as $language_item) {
                        $p_menu .= '<li role="presentation" ' . (strtoupper(Yii::$app->language)==strtoupper($language_item['language'])?'class="active localization-option"':'class="localization-option"') . '><a role="menuitem" tabindex="-1" href="' . $language_item['url'] . '">' . $language_item['label'] . '</a></li>';
                    }
    $p_menu .= '<li role="presentation" class="dropdown-header">'. Yii::t('app','Currency') .'</li>';
                    foreach ($currency_menu as $currency_item) {
                        $p_menu .= '<li role="presentation" ' . ($currency_item['label']==Yii::$app->params['currency']?'class="active localization-option"':'class="localization-option"') . '><a role="menuitem" tabindex="-1" href="' . $currency_item['url'] . '" rel="nofollow">' . $currency_item['sign'] . ' ' . $currency_item['label'] . '</a></li>';
                    }

            $p_menu .= '</ul></div>';
    $p_menu .= '<a type="button" class="btn btn-danger pull-right" href="'.Url::toRoute(['experience/index']) .  '#inquiry-form' . '">'.Yii::t('app',"LET'S PLAN YOUR TRIP").'</a>';
    $p_menu .= '</div>';

    echo $p_menu;
    NavBar::end();
    ?>

    <div class="modal" id="m-menu" tabindex="-1" role="dialog" aria-labelledby="m-menu-label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content m-menu">

        <ul>
                <li>
                        <ul class="menu-group row">
                            <li class="dropdown col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <a data-toggle="dropdown" class="dropdown">
                                <?= Yii::$app->params['language_name'][Yii::$app->language]  ?>
                                <i class="glyphicon glyphicon-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu" role="menu">
                                <?php foreach (Yii::$app->urlManager->languages as $language) { ?>
                                    <li <?= Yii::$app->language==$language?'class="active"':'' ?>><a href="<?= Url::toRoute([\common\models\Tools::getCurrentUrl(), 'language'=>$language]) ?>"><?= Yii::$app->params['language_name'][$language] ?></a></li>
                                <?php } ?>
                                </ul>
                            </li>
                            <li class="dropdown col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <a data-toggle="dropdown" class="dropdown">
                                <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['sign'] ?>
                                <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['name'] ?>
                                <i class="glyphicon glyphicon-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu sub-menu" role="menu">
                                <?php foreach (Yii::$app->params['currency_name'] as $ckey => $currency) { ?>
                                    <li <?= Yii::$app->params['currency']==$ckey?'class="active"':'' ?>><a href="<?= Url::toRoute([\common\models\Tools::getCurrentUrl(), 'currency'=>$ckey]) ?>" rel="nofollow"><?= $currency['sign'] . ' ' . $currency['name'] ?></a></li>
                                <?php } ?>
                                </ul>
                            </li>
                        </ul>
                </li>
            <li><a href="<?= Url::toRoute(['experience/search']) ?>"><?= Yii::t('app','Find a Tour') ?></a></li>
            <li><a href="<?= Url::toRoute(['experience/index']) ?>"><?= Yii::t('app','Private Tours') ?></a></li>
            <li><a href="<?= Url::toRoute(['/educational-programs']) ?>"><?= Yii::t('app','Student Tours') ?></a></li>
            <li><a href="<?= Url::toRoute(['/mice']) ?>"><?= Yii::t('app','MICE Travel') ?></a></li>
            <li><a href="<?= Url::toRoute(['destination/index']) ?>"><?= Yii::t('app','Destinations') ?></a></li>
            <li><a href="<?= Url::toRoute(['article/index']) ?>"><?= Yii::t('app','Blog') ?></a></li>
                        <li><a href="<?= Url::toRoute(['preparation/index']) ?>"><?= Yii::t('app','Preparation') ?></a></li>
                        <li><a href="<?= Url::toRoute(['/faq']) ?>"><?= Yii::t('app','FAQ') ?></a></li>
            <li><a href="<?= Url::toRoute(['/about-us']) ?>"><?= Yii::t('app','About Us') ?></a></li>
            <li class="dropdown">
                <a data-toggle="dropdown">
                <?= Yii::t('app','Call Us') ?>
                <i class="glyphicon glyphicon-chevron-down" style="color: #E0E3D6"></i>
                </a>
                <ul class="dropdown-menu sub-menu" role="menu">
                    <li><a href="tel:+861085321860">CN: +86 10 85321860</a></li>
                    <li><a href="tel:+16468637038">US: +1 646 863 7038</a></li>
                    <li><a href="tel:+61871001399">AU: +61 871001399</a></li>
                    <li><a href="tel:+442038070401">UK: +44 203 807 0401</a></li>
                </ul>
            </li>
        </ul>

        <div class="home-btn-mobile-menu">
            <div class="row btn-row">
                <a type="button" class="btn btn-danger col-lg-10 col-md-10 col-xs-10" href="<?= Url::toRoute(['experience/index']) .  '#inquiry-form' ?>"><?=Yii::t('app',"Let's Plan Your Trip")?></a>
                
            </div>
        </div>

        <!-- <div class="search-box">
            <form id="search-form" method="get" action="https://www.google.com/search" target="_blank">
                <input type="text" name="q" placeholder="<?=Yii::t('app','Search')?>">
                <input type="hidden" value="thechinaguide.com" name="sitesearch">
                <button id="search-button" type="submit">                     
                    <span><?=Yii::t('app','Search')?></span>
                </button>
            </form>
        </div> -->

        <span class="desc" style="display: none"><?=Yii::t('app','The China Guide')?><br /><?= Yii::t('app','A Beijing-based, foreign-owned travel agency.') ?></span>
    </div>
    </div>
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
            <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a href="https://www.tripadvisor.com/Attraction_Review-g294212-d2658278-Reviews-The_China_Guide-Beijing.html" target="_blank">
                                    <img src="/statics/images/trip-advisor-certificate-of-excellence-small.png">
                                </a>
                            </div>
                            <div class="social-media-icons col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3><?=Yii::t('app','Follow Us on Social Media')?></h3>
                            <div id="social-media-icons-container">
                                <a href="https://www.youtube.com/channel/UCp9ksc2bXXWcbE-CZG5iEMQ" id="youtube" target="_blank"></a>
                                <a href="http://www.instagram.com/the_chinaguide" id="instagram" target="_blank"></a>
                                <a href="https://www.facebook.com/thechinaguide" id="facebook" target="_blank"></a>
                                <a href="http://twitter.com/thechinaguide" id="twitter" target="_blank"></a>
                                <a href="http://www.linkedin.com/company/the-china-guide" id="linkedin" target="_blank"></a>
                                <a href="http://www.pinterest.com/thechinaguide" id="pinterest" target="_blank"></a>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div>
                                    <i class="glyphicon glyphicon-envelope footer-email"></i><a href="mailto:book@thechinaguide.com?subject=<?=Yii::t('app','Booking or Consultation')?>" style="display: inline-block"><h3 style="display: inline-block"><?=Yii::t('app','Email Us Your Plan')?></h3></a>
                                </div>
                                <div>
                                <i class="glyphicon glyphicon-credit-card footer-credit-card"></i><a href="<?= Url::toRoute(['form-card/create']) ?>" style="display: inline-block"><h3 style="display: inline-block"><?=Yii::t('app','Secure Credit Card Form')?></h3></a>
                            </div>
                            </div>
                        </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <h3><?=Yii::t('app','The Company')?></h3>
                    <div>
                        <a href="<?= Url::toRoute(['/about-us']) ?>"><?=Yii::t('app','Who We Are')?></a>
                        <a href="<?= Url::toRoute(['about-us/meet-our-team']) ?>"><?=Yii::t('app','Meet our team')?></a>
                        <a href="<?= Url::toRoute(['about-us/our-guides']) ?>"><?=Yii::t('app','Our guides')?></a>
                        <a href="<?= Url::toRoute(['about-us/drivers-and-vehicles']) ?>"><?=Yii::t('app','Drivers & Vehicles')?></a>
                        <a href="<?= Url::toRoute(['about-us/contact-us']) ?>"><?=Yii::t('app','Contact us')?></a>
                        <a href="<?= Url::toRoute(['about-us/company-policies']) ?>"><?=Yii::t('app','Terms of Service')?></a>
                        <a href="<?= Url::toRoute(['/faq']) ?>"><?=Yii::t('app','FAQ')?></a>
                        <a href="/statics/pages/company_profile.pdf"><?=Yii::t('app','Company Profile')?></a>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <h3><?=Yii::t('app','Private Tours')?></h3>
                        <div>
                            <?php if( ($themes = \common\models\Tools::getAllTheme() )!== null) {
                             foreach ($themes as $theme) {
                            ?>
                            <a href="<?= Url::toRoute(['experience/index', 'theme'=>$theme['url_id']]) ?>"><?= $theme['name'] ?></a> 
                            <?php } } ?>
                        </div>
                    </div>
                    <!-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <h3><?=Yii::t('app','Destinations')?></h3>
                        <div>
                            <?php if( ($cities = \common\models\Tools::getMostPopularCities(9) )!== null) {
                                foreach ($cities as $city) {
                            ?>
                            <a href="<?= Url::toRoute(['destination/view', 'url_id'=>$city['url_id']]) ?>"><?= $city['name'] ?></a> 
                            <?php } } ?>
                        </div>
                    </div> -->
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="fitem payment-icons col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3><?=Yii::t('app','Payment Options')?></h3>
                            <div>
                                <i class="footer-icons payment"></i>
                            </div>
                        </div>
                        <div class="social-media-icons col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3><?=Yii::t('app','Security')?></h3>
                            <div>
                                <a href="https://secure.comodo.com/ttb_searcher/trustlogo?v_querytype=W&v_shortname=CL1&v_search=https://www.thechinaguide.com/&x=6&y=5" target="_blank"><img src="/statics/images/comodo_secure_seal_113x59_transp.png"></a>
                            </div>
                        </div>
                        <div class="partnership-membership col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3><?=Yii::t('app','Partnerships')?></h3>
                            <div>
                                <!-- <i class="footer-icons partnership"></i> -->
                                <a href="/misc/animals-asia" class="icon-link"><i class="footer-icons membership"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <div class="copyright">
        <p>Copyright &copy; 2008 - <?= date('Y') ?> <?=Yii::t('app','The China Guide')?></p>
    </div>
        

        <p class="pull-right"><?//= Yii::powered() ?></p>
</footer>
<div id="gotop"><i class="glyphicon glyphicon-chevron-up"></i><br /><?=Yii::t('app','TOP')?></div>
<?php $this->endBody() ?>
<?php
$js = <<<JS
  var _is_mobile = 0;
JS;
if (Yii::$app->params['is_mobile']) {
$js = <<<JS
  var _is_mobile = 1;
JS;
}
$this->registerJs($js);
?>
<?php
$js = <<<JS
    $(function(){
        $('.navbar-toggle').attr('id', 'bt_toggle');
        $('.navbar-toggle').click(function(){
            $('body,html').animate({scrollTop:0},0);
            $('.navbar-collapse.collapse').hide();
            // if($('.m-menu').is(":visible")){
            //     $('.m-menu').hide();
            // }
            // else{
            //     $('.m-menu').show();
            // }
            $('#m-menu').modal('toggle');
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

        $('ul.nav li.dropdown').hover(function() {
          $(this).find('>.dropdown-menu').stop(true, true).delay(0).fadeIn(0);
        }, function() {
          $(this).find('>.dropdown-menu').stop(true, true).delay(0).fadeOut(0);
        });
    });
JS;
$this->registerJs($js);
?>

<?php if(\Yii::$app->controller->id == 'site' && \Yii::$app->controller->action->id == 'index') { ?>
<script src="//my.hellobar.com/74e24eabbac970c8d9108d35dcaee0d202bf388b.js" type="text/javascript" charset="utf-8" async="async"></script>
<?php } ?>

</body>
</html>
<?php $this->endPage() ?>