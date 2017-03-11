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
    <title><?= Html::encode($this->title) ?><?php if(\Yii::$app->controller->id == 'site' && \Yii::$app->controller->action->id == 'index') {} else { ?> - <?=Yii::t('app','The China Guide')?><?php } ?></title>
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
    $menuItems = [
        ['label' => Yii::t('app','Find a Tour'), 'url' => ['experience/search'], 'active' => (\Yii::$app->controller->id == 'experience' && \Yii::$app->controller->action->id == 'search')],
        ['label' => Yii::t('app','Experiences'), 'url' => ['experience/index'], 'active' => (\Yii::$app->controller->id == 'experience' && \Yii::$app->controller->action->id == 'index')],
        ['label' => Yii::t('app','Destinations'), 'url' => ['/destinations'], 'active' => \Yii::$app->controller->id == 'destination'],
        ['label' => Yii::t('app','Educational Programs'), 'url' => ['/educational-programs'], 'active' => \Yii::$app->controller->id == 'educational-programs'],
        ['label' => Yii::t('app','Themed Tours'), 'url' => ['join-a-group/index'], 'active' => \Yii::$app->controller->id == 'join-a-group'],
        ['label' => Yii::t('app','More'), 'active' => (\Yii::$app->controller->id == 'article' || \Yii::$app->controller->id == 'preparation' || \Yii::$app->controller->id == 'about-us'), 'items' =>[['label' => Yii::t('app','Blog'), 'url' => ['/article/index'], 'active' => \Yii::$app->controller->id == 'article'],
        ['label' => Yii::t('app','Preparation'), 'url' => ['/preparation'], 'active' => \Yii::$app->controller->id == 'preparation'],
        ['label' => Yii::t('app','About Us'), 'url' => ['/about-us'], 'active' => \Yii::$app->controller->id == 'about-us', ],]],

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
              <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="p-menu-search">
              <li class="p-menu-search"><form id="search-form" method="get" action="https://www.google.com/search" target="_blank">
            <input type="text" name="q" placeholder="'.Yii::t('app','SEARCH').'">
            <input type="hidden" value="thechinaguide.com" name="sitesearch" />
            </form>
            </li>';
    $p_menu .= '</ul></div>
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="p-menu-setting" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></button>
              <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="p-menu-setting">
                <li role="presentation" class="dropdown-header">'. Yii::t('app','Language') .'</li>';
                    foreach ($languages_menu as $language_item) {
                        $p_menu .= '<li role="presentation" ' . (strtoupper(Yii::$app->language)==strtoupper($language_item['language'])?'class="active"':'') . '><a role="menuitem" tabindex="-1" href="' . $language_item['url'] . '">' . $language_item['label'] . '</a></li>';
                    }
    $p_menu .= '<li role="presentation" class="dropdown-header">'. Yii::t('app','Currency') .'</li>';
                    foreach ($currency_menu as $currency_item) {
                        $p_menu .= '<li role="presentation" ' . ($currency_item['label']==Yii::$app->params['currency']?'class="active"':'') . '><a role="menuitem" tabindex="-1" href="' . $currency_item['url'] . '" rel="nofollow">' . $currency_item['sign'] . ' ' . $currency_item['label'] . '</a></li>';
                    }

            $p_menu .= '</ul></div>';
    $p_menu .= '<a type="button" class="btn btn-danger pull-right" href="'.Url::toRoute(['experience/index']) .  '#inquiry-form' . '">'.Yii::t('app',"Let's Plan Your Trip").'</a>';
    $p_menu .= '</div>';

    echo $p_menu;
    NavBar::end();
    ?>

    <div class="modal" id="m-menu" tabindex="-1" role="dialog" aria-labelledby="m-menu-label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content m-menu">

        <ul class="">
            <li><a href="<?= Url::toRoute(['experience/search']) ?>"><?= Yii::t('app','Find a Tour') ?></a></li>
            <li><a href="<?= Url::toRoute(['experience/index']) ?>"><?= Yii::t('app','Experiences') ?></a></li>
            <li><a href="<?= Url::toRoute(['destination/index']) ?>"><?= Yii::t('app','Destinations') ?></a></li>
            <li><a href="<?= Url::toRoute(['/educational-programs']) ?>"><?= Yii::t('app','Educational Programs') ?></a></li>
            <li><a href="<?= Url::toRoute(['join-a-group/index']) ?>"><?= Yii::t('app','Themed Tours') ?></a></li>
            <li class="">
                <ul class="menu-group row">
                    <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a href="<?= Url::toRoute(['article/index']) ?>"><?= Yii::t('app','Blog') ?></a></li>
                    <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a href="<?= Url::toRoute(['preparation/index']) ?>"><?= Yii::t('app','Preparation') ?></a></li>
                </ul>
            </li>
        </ul>
        <ul class="">
            <li><a href="<?= Url::toRoute(['/about-us']) ?>"><?= Yii::t('app','About Us') ?></a></li>
            <li class="dropdown">
                <a data-toggle="dropdown">
                <?= Yii::t('app','Call Us') ?>
                <i class="glyphicon glyphicon-chevron-down"></i>
                </a>
                <ul class="dropdown-menu sub-menu" role="menu">
                    <li><a href="tel:+861085321860">CN: +86 10 85321860</a></li>
                    <li><a href="tel:+16468637038">US: +1 646 863 7038</a></li>
                    <li><a href="tel:+442038070401">UK: +44 203 807 0401</a></li>
                </ul>
            </li>
        </ul>

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

        <div class="home-btn">
            <div class="row btn-row">
                <a type="button" class="btn btn-danger col-lg-10 col-md-10 col-xs-10" href="<?= Url::toRoute(['experience/index']) .  '#inquiry-form' ?>"><?=Yii::t('app',"Let's Plan Your Trip")?></a>
                
            </div>
        </div>

        <div class="search-box">
            <form id="search-form" method="get" action="https://www.google.com/search" target="_blank">
                <input type="text" name="q" placeholder="<?=Yii::t('app','Powered by Google')?>">
                <input type="hidden" value="thechinaguide.com" name="sitesearch">
                <button id="search-button" type="submit">                     
                    <span><?=Yii::t('app','Search')?></span>
                </button>
            </form>
        </div>

        <span class="desc"><?=Yii::t('app','The China Guide')?><br /><?= Yii::t('app','A Beijing-based, foreign-owned travel agency.') ?></span>
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
    <div class="container fleft col-lg-5 col-md-4 col-sm-12 col-xs-12"> 
        <div class="fitem social-media-icons">
            <h3><?=Yii::t('app','Follow us')?></h3>
            <div id="social-media-icons-container">
                <a href="https://www.tripadvisor.com/Attraction_Review-g294212-d2658278-Reviews-The_China_Guide-Beijing.html" id="tripadvisor" target="_blank"></a>
                <a href="http://www.instagram.com/the_chinaguide" id="instagram" target="_blank"></a>
                <a href="https://www.facebook.com/thechinaguide" id="facebook" target="_blank"></a>
                <a href="http://twitter.com/thechinaguide" id="twitter" target="_blank"></a>
                <a href="http://www.linkedin.com/company/the-china-guide" id="linkedin" target="_blank"></a>
                <a href="http://www.pinterest.com/thechinaguide" id="pinterest" target="_blank"></a>
            </div>
        </div>
        <div class="fitem payment-icons col-lg-7 col-md-12 col-sm-12 col-xs-12">
            <h3><?=Yii::t('app','Payment')?></h3>
            <div>
                <i class="footer-icons payment"></i>
            </div>
        </div>
        <div class="fitem social-media-icons col-lg-5 col-md-12 col-sm-12 col-xs-12">
            <h3><?=Yii::t('app','Security')?></h3>
            <div>
                <a href="https://secure.comodo.com/ttb_searcher/trustlogo?v_querytype=W&v_shortname=CL1&v_search=https://www.thechinaguide.com/&x=6&y=5" target="_blank"><img src="/statics/images/comodo_secure_seal_113x59_transp.png"></a>
            </div>
        </div>
        <div class="fitem partnership-membership col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3><?=Yii::t('app','Partnership & Membership')?></h3>
            <div>
                <i class="footer-icons partnership"></i>
                <a href="/misc/animals-asia" class="icon-link"><i class="footer-icons membership"></i></a>
            </div>
        </div>
    </div>
    <div class="container fright col-lg-7 col-md-8 col-sm-12 col-xs-12">
        <div class="fitem col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <h3><?=Yii::t('app','The Company')?></h3>
            <div class="flink">
                <a href="<?= Url::toRoute(['/about-us']) ?>"><?=Yii::t('app','Why choose us')?></a>
                <a href="<?= Url::toRoute(['about-us/meet-our-team']) ?>"><?=Yii::t('app','Meet our team')?></a>
                <a href="<?= Url::toRoute(['about-us/our-guides']) ?>"><?=Yii::t('app','Our guides')?></a>
                <a href="<?= Url::toRoute(['about-us/drivers-and-vehicles']) ?>"><?=Yii::t('app','Drivers & Vehicles')?></a>
                <a href="<?= Url::toRoute(['about-us/contact-us']) ?>"><?=Yii::t('app','Contact us')?></a>
                <a href="<?= Url::toRoute(['/company-policies']) ?>"><?=Yii::t('app','Company policies')?></a>
            </div>
            <a href="mailto:book@thechinaguide.com?subject=<?=Yii::t('app','Booking or Consultation')?>"><h3><?=Yii::t('app','Email us your plan')?></h3></a>
            <a href="<?= Url::toRoute(['form-card/create']) ?>"><h3><?=Yii::t('app','Secure Credit Card Form')?></h3></a>

        </div>
        <div class="fitem col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <h3><?=Yii::t('app','Experiences')?></h3>
            <div class="flink">
                <?php if( ($tours = \common\models\Tools::getMostPopularTours(9) )!== null) {
                 foreach ($tours as $tour) {
                ?>
                <a href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"><?= $tour['name'] ?></a> 
                <?php } } ?>
            </div>
        </div>
        <div class="fitem col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <h3><?=Yii::t('app','Destinations')?></h3>
            <div class="flink">
                <?php if( ($cities = \common\models\Tools::getMostPopularCities(9) )!== null) {
                    foreach ($cities as $city) {
                ?>
                <a href="<?= Url::toRoute(['destination/view', 'url_id'=>'The-Great-Wall']) ?>"><?= $city['name'] ?></a> 
                <?php } } ?>
            </div>
        </div>
    </div>

    </div>
    <div class="copyright">
        <p>&copy; 2008 - <?= date('Y') ?> <?=Yii::t('app','The China Guide')?></p>
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
    });
JS;
$this->registerJs($js);
?>
</body>
</html>
<?php $this->endPage() ?>
