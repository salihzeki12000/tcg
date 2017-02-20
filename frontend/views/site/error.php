<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;

$tours = \common\models\Tools::getMostPopularTours();
?>
<div class="site-error">

        <div class="content col-lg-5 col-md-8 col-xs-12">
        <h1><?= nl2br(Html::encode($message)) ?></h1>

        <table class="pagebox_small">
            <tbody><tr>
                <td>
                    <?=Yii::t('app','Sorry, we couldn\'t find the page you were looking for.')?> 
                    <h3><?=Yii::t('app','Most Popular Pages')?></h3>
                    <?=Yii::t('app','You might have been trying to find one of these pages:')?>
                    <ul>
                        <?php foreach ($tours as $tour) { ?>
                        <li>
                            <a href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>">
                                <?= $tour['name'] ?></a>
                        </li>
                        <?php } ?>
                    </ul>

                    <h3><?=Yii::t('app','Try the Homepage')?></h3>
                    <?=Yii::t('app','Start your journey on our')?>
                    <a href="<?= Url::toRoute(['/']) ?>"><?=Yii::t('app','homepage')?></a>.
                </td>
            </tr>
        </tbody>
        </table>
    </div>


</div>
