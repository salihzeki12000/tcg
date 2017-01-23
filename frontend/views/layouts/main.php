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
        $languages_menu[] = ['language'=>$language, 'label' => Yii::$app->params['language_name'][$language], 'url' => Url::toRoute(['/', 'language'=>$language])];
    }
    foreach (Yii::$app->params['currency_name'] as $currency_item){
        $currency_menu[] = ['sign'=>$currency_item['sign'], 'label' => $currency_item['name'], 'url' => Url::toRoute(['site/currency', 'currency'=> $currency_item['name']])];
    }
    $menuItems = [
        ['label' => Yii::t('app','Find A Tour'), 'url' => ['experience/search'], 'active' => (\Yii::$app->controller->id == 'experience' && \Yii::$app->controller->action->id == 'search')],
        ['label' => Yii::t('app','Experiences'), 'url' => ['experience/index'], 'active' => (\Yii::$app->controller->id == 'experience' && \Yii::$app->controller->action->id == 'index')],
        ['label' => Yii::t('app','Destinations'), 'url' => ['/destinations'], 'active' => \Yii::$app->controller->id == 'destination'],
        ['label' => Yii::t('app','Educational Programs'), 'url' => ['/educational-programs'], 'active' => \Yii::$app->controller->id == 'educational-programs'],
        ['label' => Yii::t('app','Count Me In'), 'url' => ['count-me-in/index'], 'active' => \Yii::$app->controller->id == 'count-me-in'],
        ['label' => Yii::t('app','More'), 'active' => (\Yii::$app->controller->id == 'article' || \Yii::$app->controller->id == 'faq' || \Yii::$app->controller->id == 'about'), 'items' =>[['label' => Yii::t('app','Blogs'), 'url' => ['/article/index'], 'active' => \Yii::$app->controller->id == 'article'],
        ['label' => Yii::t('app','FAQ'), 'url' => ['/faq'], 'active' => \Yii::$app->controller->id == 'faq'],
        ['label' => Yii::t('app','About Us'), 'url' => ['/about'], 'active' => \Yii::$app->controller->id == 'about', ],]],

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
              <li class="p-menu-search"><form id="search-form" method="get" action="http://www.google.com/search" target="_blank">
            <input type="text" name="q" placeholder="'.Yii::t('app','SEARCH').'">
            <input type="hidden" value="http://www.thechinaguide.com" name="sitesearch" />
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
                        $p_menu .= '<li role="presentation" ' . ($currency_item['label']==Yii::$app->params['currency']?'class="active"':'') . '><a role="menuitem" tabindex="-1" href="' . $currency_item['url'] . '">' . $currency_item['sign'] . ' ' . $currency_item['label'] . '</a></li>';
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
            <li><a href="<?= Url::toRoute(['experience/search']) ?>"><?= Yii::t('app','Find A Tour') ?></a></li>
            <li><a href="<?= Url::toRoute(['experience/index']) ?>"><?= Yii::t('app','Experiences') ?></a></li>
            <li><a href="<?= Url::toRoute(['destination/index']) ?>"><?= Yii::t('app','Destinations') ?></a></li>
            <li><a href="<?= Url::toRoute(['/educational-programs']) ?>"><?= Yii::t('app','Educational Programs') ?></a></li>
            <li><a href="<?= Url::toRoute(['count-me-in/index']) ?>"><?= Yii::t('app','Count Me In') ?></a></li>
            <li class="">
                <ul class="menu-group row">
                    <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a href="<?= Url::toRoute(['article/index']) ?>"><?= Yii::t('app','Blogs') ?></a></li>
                    <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a href="<?= Url::toRoute(['faq/index']) ?>"><?= Yii::t('app','FAQ') ?></a></li>
                </ul>
            </li>
        </ul>
        <ul class="">
            <li><a href="<?= Url::toRoute(['/about']) ?>"><?= Yii::t('app','About Us') ?></a></li>
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
                    <li <?= Yii::$app->language==$language?'class="active"':'' ?>><a href="<?= Url::toRoute(['/', 'language'=>$language]) ?>"><?= Yii::$app->params['language_name'][$language] ?></a></li>
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
                    <li <?= Yii::$app->params['currency']==$ckey?'class="active"':'' ?>><a href="<?= Url::toRoute(['site/currency', 'currency'=>$ckey]) ?>"><?= $currency['sign'] . ' ' . $currency['name'] ?></a></li>
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
            <form id="search-form" method="get" action="http://www.google.com/search" target="_blank">
                <input type="text" name="q" placeholder="<?=Yii::t('app','Powered by Google')?>">
                <input type="hidden" value="http://www.thechinaguide.com" name="sitesearch">
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
            <a href="<?= Url::toRoute(['experience/index']) . '#inquiry-form' ?>"><?=Yii::t('app','Plan a vacation')?></a> | 
            <a href="<?= Url::toRoute(['/educational-programs']) . '#inquiry-form' ?>"><?=Yii::t('app','Plan an educational trip')?></a> | 
            <!-- <a href="<?= Url::toRoute(['/meetings-incentives']) . '#inquiry-form' ?>"><?=Yii::t('app','Plan an incentive trip')?></a> | --> 
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
