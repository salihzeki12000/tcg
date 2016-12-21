<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-info-form">

    <?php $form = ActiveForm::begin(['action' => Url::toRoute(['form-info/create', 'form_type' => $form_type])]);
        $form_fields = Yii::$app->params['form_fields'][$form_type]; 
    ?>
    <?= Html::activeHiddenInput($model, 'type', ['value'=>$form_type]) ?>

    <?= !in_array('tour_code', $form_fields) ? '' : Html::activeHiddenInput($model, 'tour_code', ['value'=>$tour_code]) ?>

    <?= !in_array('tour_name', $form_fields) ? '' : Html::activeHiddenInput($model, 'tour_name', ['value'=>$tour_name]) ?>

    <?= !in_array('subject_program', $form_fields) ? '' : $form->field($model, 'subject_program')->textInput(['maxlength' => true]) ?>

    <?= !in_array('participants_number', $form_fields) ? '' : $form->field($model, 'participants_number')->textInput(['maxlength' => true]) ?>

    <?= !in_array('purpose_trip', $form_fields) ? '' : $form->field($model, 'purpose_trip')->textInput(['maxlength' => true]) ?>

    <?= !in_array('number_participants', $form_fields) ? '' : $form->field($model, 'number_participants')->textInput(['maxlength' => true]) ?>

    <?php if(in_array('arrival_date', $form_fields)) { ?>
        <label class="control-label" for="">Arrival (In China) </label>
        <table width="100%">
            <tr>
                <td width="50%" valign="top">
                    <?= $form->field($model, 'arrival_date')->textInput(['maxlength' => true, 'placeholder' =>'Select Date' ])->label(false) ?>
                </td>
                <td width="50%" valign="top">
                    <?= $form->field($model, 'arrival_city')->dropDownList([ 'Beijing' => 'Beijing', 'Shanghai' => 'Shanghai', 'Guangzhou' => 'Guangzhou', 'Hongkong' => 'Hongkong', 'Other' => 'Other', ], ['prompt' => 'Select City'])->label(false) ?>
                </td>
            </tr>
        </table>
        <?php if(in_array('departure_date', $form_fields)) { ?>
            <label class="control-label" for="">Departure (In China) </label>
            <table width="100%">
                <tr>
                    <td width="50%" valign="top">
                        <?= $form->field($model, 'departure_date')->textInput(['maxlength' => true, 'placeholder' =>'Select Date' ])->label(false) ?>
                    </td>
                    <td width="50%" valign="top">
                        <?= $form->field($model, 'departure_city')->dropDownList([ 'Beijing' => 'Beijing', 'Shanghai' => 'Shanghai', 'Guangzhou' => 'Guangzhou', 'Hongkong' => 'Hongkong', 'Other' => 'Other', ], ['prompt' => 'Select City'])->label(false) ?>
                    </td>
                </tr>
            </table>
        <?php } ?>
    <?php } ?>

    <?= !in_array('ideas', $form_fields) ? '' : $form->field($model, 'ideas')->textarea(['maxlength' => true, 'rows'=>3, 'placeholder' => 'the cities you want to visit, the companies you want to interview, the classes or activities you want to participate, etc.']) ?>

    <?= !in_array('ideas_trip', $form_fields) ? '' : $form->field($model, 'ideas_trip')->textarea(['maxlength' => true, 'rows'=>3, 'placeholder' => '']) ?>

    <?php if(in_array('adults', $form_fields)) { ?>
    <label class="control-label" for="">Guest Information</label>
    <table width="100%">
        <tr>
            <td width="50%" valign="middle">
                <?= $form->field($model, 'adults')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15', 16 => '16', 17 => '17', 18 => '18', 19 => '19', 20 => '20', ], ['prompt' => ''])->label(false) ?>
            </td>
            <td width="50%" valign="middle">
                <label class="control-label">Adults (> 12 yrs)</label>
            </td>
        </tr>
        <tr>
            <td width="50%" valign="middle">
                <?= $form->field($model, 'children')->dropDownList([ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', ], ['prompt' => ''])->label(false) ?>
            </td>
            <td width="50%" valign="middle" class="control-label">
                <label class="control-label">Children (3 - 12 yrs)</label>
            </td>
        </tr>
        <tr>
            <td width="50%" valign="middle">
                <?= $form->field($model, 'infants')->dropDownList([ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', ], ['prompt' => ''])->label(false) ?>
            </td>
            <td width="50%" valign="middle" class="control-label">
                <label class="control-label">Infants (< 3 yrs)</label>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?= $form->field($model, 'guest_information')->textarea(['maxlength' => true, 'rows'=>3, 'placeholder' => 'Please let us know if someone needs particular assistance in your group. Please tell us children\'s height for a possible discount.'])->label(false) ?>
            </td>
        </tr>
    </table>
    <?php } ?>

    <?= !in_array('book_hotels', $form_fields) ? '' : $form->field($model, 'book_hotels')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => 'Please select']) ?>

    <?= !in_array('hotel_preferences', $form_fields) ? '' : $form->field($model, 'hotel_preferences')->dropDownList([ '3 star or equal' => '3 star or equal', '4 star or equal' => '4 star or equal', '5 star or equal' => '5 star or equal', ], ['prompt' => '']) ?>

    <?= !in_array('room_requirements', $form_fields) ? '' : $form->field($model, 'room_requirements')->textarea(['maxlength' => true, 'rows'=>3, 'placeholder' => 'Please let us know how many and what types of rooms you want, as well as other requirements.']) ?>

    <?= !in_array('group_type', $form_fields) ? '' : $form->field($model, 'group_type')->dropDownList([ 'Family' => 'Family', 'Couple' => 'Couple', 'Friends' => 'Friends', 'Business' => 'Business', 'Solo' => 'Solo', 'Other' => 'Other', ], ['prompt' => 'Select Type']) ?>

    <?= !in_array('cities_plan', $form_fields) ? '' : $form->field($model, 'cities_plan')->checkboxList(['Beijing'=>'Beijing','Xian'=>'Xian','Shanghai'=>'Shanghai','Guilin'=>'Guilin','Zhangjiajie'=>'Zhangjiajie','Tibet/Lhasa'=>'Tibet/Lhasa','Guangzhou'=>'Guangzhou','Hangzhou'=>'Hangzhou','Chengdu'=>'Chengdu','Luoyang'=>'Luoyang','Other'=>'Other']) ?>

    <?= !in_array('travel_interests', $form_fields) ? '' : $form->field($model, 'travel_interests')->checkboxList(['Chinese culture'=>'Chinese culture','Nature'=>'Nature','Adventure'=>'Adventure','Chinese food'=>'Chinese food','Buddhism'=>'Buddhism']) ?>

    <?= !in_array('prefered_budget', $form_fields) ? '' : $form->field($model, 'prefered_budget')->dropDownList([ 'Below 1499 USD' => 'Below 1499 USD', '1500 to 2999 USD' => '1500 to 2999 USD', '3000 to 4999 USD' => '3000 to 4999 USD', 'Above 5000 USD' => 'Above 5000 USD', ], ['prompt' => 'Select a budget']) ?>

    <?= !in_array('additional_information', $form_fields) ? '' : $form->field($model, 'additional_information')->textInput(['maxlength' => true]) ?>

    <?php if(in_array('name', $form_fields)) { ?>
    <label class="control-label" for="">Your Name</label>
    <table width="100%">
        <tr>
            <td width="30%" valign="top">
                <?= $form->field($model, 'name_prefix')->dropDownList([ 'Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Miss' => 'Miss', ], ['prompt' => ''])->label(false) ?>
            </td>
            <td width="70%" valign="top">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
            </td>
        </tr>
    </table>
    <?php } ?>

    <?= !in_array('email', $form_fields) ? '' : $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= !in_array('school_name', $form_fields) ? '' : $form->field($model, 'school_name')->textInput(['maxlength' => true]) ?>

    <?= !in_array('company_name', $form_fields) ? '' : $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= !in_array('position', $form_fields) ? '' : $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
    
    <?= !in_array('nationality', $form_fields) ? '' : $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= !in_array('prefered_travel_agent', $form_fields) ? '' : $form->field($model, 'prefered_travel_agent')->dropDownList([ 'English' => 'English', 'Français' => 'Français', 'Español' => 'Español', 'Deutsch' => 'Deutsch', '中文' => '中文', ], ['prompt' => '']) ?>

    <?= !in_array('phone_number', $form_fields) ? '' : $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= !in_array('hear_about_us', $form_fields) ? '' : $form->field($model, 'hear_about_us')->textInput(['maxlength' => true]) ?>

    <div class="form-group bt-submit">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['frontend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['frontend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        $("#forminfo-arrival_date").attr("readonly","readonly").datepicker({});
        $("#forminfo-departure_date").attr("readonly","readonly").datepicker({});

        $('.field-forminfo-hotel_preferences').hide();
        $('.field-forminfo-room_requirements').hide();
        $('#forminfo-book_hotels').change(function(){
            if(this.value=='Yes'){
                $('.field-forminfo-hotel_preferences').show();
                $('.field-forminfo-room_requirements').show();
            }
            else{
                $('.field-forminfo-hotel_preferences').hide();
                $('.field-forminfo-room_requirements').hide();
            }
        });
    });
JS;
$this->registerJs($js);
?>