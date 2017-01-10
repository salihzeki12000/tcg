<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UploadedFilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Uploaded Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploaded-files-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= (Yii::$app->language != Yii::$app->sourceLanguage) ? '' : Html::a(Yii::t('app', 'Create Uploaded Files'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            // 'org_name',
            [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img(Yii::$app->params['uploads_url'] . UploadedFiles::getSize($data['path'], 's'),
                        ['width' => '70px']);
                 },
            ],
            'create_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
