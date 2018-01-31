<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaOtherCostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Other Costs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-other-cost-index">

	<?php if($permission['canAdd']) { ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Other Cost'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
				'attribute'=>'id',
				'format' => 'raw',
				'value' => function($model) {
					return '<a href="' . Url::to(['oa-other-cost/view', 'id'=>$model['id']]) . '" target="_blank">' . $model['id'] . '</a>';
				},
				'footer' => 'Total'
            ],
            'name',
            [
                'attribute'=>'city_id',
                'filter'=>ArrayHelper::map(\common\models\OaCity::find()->asArray()->all(), 'id', 'name'),
                'value' => function ($data) {
                    return \common\models\OaCity::findOne($data['city_id'])->name;
                }
            ],
            'create_time',
            // 'contact_person_info:ntext',
            // 'bank_info:ntext',
            // 'note:ntext',
        ],
    ]); ?>
</div>
