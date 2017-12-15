<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <?php $form = ActiveForm::begin(['action' => Url::toRoute(['user/user-sub']), 'id'=>'user-form']); ?>
        <input name="User[id]" type="hidden" value="<?=$model->id?>">
        <div class="form-group">
            <label class="control-label">Subordinate</label>
            <div>
                <?php foreach ($allAgent as $user_id => $username) { ?>
                    <label><input type="checkbox" name="OaUserSub[sub_id][]" value="<?=$user_id?>" <?= isset($subAgent[$user_id])? 'checked' : ''?>> <?=$username?></label>
                <?php } ?>
            </div>
            <input class="btn btn-success" type="submit" name="" value="Submit">
        </div>

    <?php ActiveForm::end(); ?>
</div>
