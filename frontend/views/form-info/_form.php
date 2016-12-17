<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="container">
        <div class="row">
            <?php 
                // echo $form->field($model, 'arrival_date', [
                //     'template' => '{input}{error}{hint}'
                //  ]);
            ?>
            <!-- <?//= $form->field($model, 'arrival_date')->textInput(['maxlength' => true, 'placeholder' =>'Select Date' ]) ?> -->

            <!-- <?//= $form->field($model, 'arrival_city')->dropDownList([ 'Beijing' => 'Beijing', 'Shanghai' => 'Shanghai', 'Guangzhou' => 'Guangzhou', 'Hongkong' => 'Hongkong', 'Other' => 'Other', ], ['prompt' => 'Select City']) ?> -->
        </div>
    </div>

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

    <label class="control-label" for="">Guest Information</label>
    <table width="100%">
        <tr>
            <td width="50%" valign="middle">
                <?= $form->field($model, 'adults')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15', 16 => '16', 17 => '17', 18 => '18', 19 => '19', 20 => '20', ], ['prompt' => ''])->label(false) ?>
            </td>
            <td width="50%" valign="middle">
                Adults (> 12 yrs)
            </td>
        </tr>
        <tr>
            <td width="50%" valign="middle">
                <?= $form->field($model, 'children')->dropDownList([ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', ], ['prompt' => ''])->label(false) ?>
            </td>
            <td width="50%" valign="middle">
                Children (3 - 12 yrs)
            </td>
        </tr>
        <tr>
            <td width="50%" valign="middle">
                <?= $form->field($model, 'infants')->dropDownList([ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', ], ['prompt' => ''])->label(false) ?>
            </td>
            <td width="50%" valign="middle">
                Infants (< 3 yrs)
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?= $form->field($model, 'guest_information')->textarea(['maxlength' => true, 'rows'=>3, 'placeholder' => 'Please let us know if someone needs particular assistance in your group. Please tell us children\'s height for a possible discount.'])->label(false) ?>
            </td>
        </tr>
    </table>


    <?= $form->field($model, 'group_type')->dropDownList([ 'Family' => 'Family', 'Couple' => 'Couple', 'Friends' => 'Friends', 'Business' => 'Business', 'Solo' => 'Solo', 'Other' => 'Other', ], ['prompt' => 'Select Type']) ?>

    <?= $form->field($model, 'cities_plan')->checkboxList(['Beijing','Xian','Shanghai','Guilin','Zhangjiajie','Tibet/Lhasa','Guangzhou','Hangzhou','Chengdu','Luoyang','Other']) ?>

    <?= $form->field($model, 'travel_interests')->checkboxList(['Chinese culture','Nature','Adventure','Chinese food','Buddhism']) ?>

    <?= $form->field($model, 'prefered_budget')->dropDownList([ 'Below 1499 USD' => 'Below 1499 USD', '1500 to 2999 USD' => '1500 to 2999 USD', '3000 to 4999 USD' => '3000 to 4999 USD', 'Above 5000 USD' => 'Above 5000 USD', ], ['prompt' => 'Select a budget']) ?>

    <?= $form->field($model, 'additional_information')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prefered_travel_agent')->dropDownList([ 'English' => 'English', 'Français' => 'Français', 'Español' => 'Español', 'Deutsch' => 'Deutsch', '中文' => '中文', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tour_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_hotels')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => 'Please select']) ?>

    <?= $form->field($model, 'hotel_preferences')->dropDownList([ '3 star or equal' => '3 star or equal', '4 star or equal' => '4 star or equal', '5 star or equal' => '5 star or equal', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'room_requirements')->textarea(['maxlength' => true, 'rows'=>3, 'placeholder' => 'Please let us know how many and what types of rooms you want, as well as other requirements.']) ?>

    <?= $form->field($model, 'subject_program')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'participants_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ideas')->textarea(['maxlength' => true, 'rows'=>3, 'placeholder' => 'the cities you want to visit, the companies you want to interview, the classes or activities you want to participate, etc.']) ?>

    <?= $form->field($model, 'school_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hear_about_us')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purpose_trip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_participants')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ideas_trip')->textarea(['maxlength' => true, 'rows'=>3, 'placeholder' => '']) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['frontend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['frontend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        $("#forminfo-arrival_date").datepicker({});
        $("#forminfo-departure_date").datepicker({});

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