<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\UploadedFiles */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Uploaded Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploaded-files-view">

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
            'title',
            // 'org_name',
            [
              'attribute'=>'image',
              'label'=> Yii::t('app', 'Post Picture'),
              'value'=> Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->path, 's'),
              'format'=>['image',['width'=>100]]
            ],
            'create_time',
        ],
    ]) ?>

</div>
