<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Cities */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cities-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'status',
            [
              'attribute'=>'image',
              'label'=> Yii::t('app', 'Title Picture'),
              // 'value'=> Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 's'),
              // 'format'=>['image',['width'=>100]]
              'format' => 'raw',
              'value' => "<a href='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 'l') . "' target='_blank'><img src='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 's') . "' width='200px' /></a>",
            ],
            'priority',
            'introduction:ntext',
            'food:ntext',
            'rec_type',
            'keywords',
            'vr',
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
<?php
/*
echo Html::a('创建', '#', [ 'id' => 'create', 'data-toggle' => 'modal', 'data-target' => '#create-modal', 'class' => 'btn btn-success', ]);
?>

<?php
Modal::begin([
    'id' => 'create-modal',
    'header' => '<h4 class="modal-title">创建</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]); 
$requestUrl = Url::toRoute('/uploaded-files/create');
$js = <<<JS
    var src = $(this).attr('data-src');
    var height = $(this).attr('data-height') || 600;
    var width = $(this).attr('data-width') || 800;

    $('.modal-body').html('<iframe class="iframeedit" style="width:'+width+'px;min-height:'+height+'px;border:none;" src="{$requestUrl}"></iframe>');
JS;
$this->registerJs($js);
Modal::end(); 
*/
?>
