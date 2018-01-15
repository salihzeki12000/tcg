<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-info-form">
    <hr />
    <?php $form = ActiveForm::begin(['action' => Url::toRoute(['form-info/create', 'form_type' => $form_type]), 'id'=>'form-info-form']);
        $form_fields = Yii::$app->params['form_fields'][$form_type]; 
        if (!isset($tour_id)) {
            $tour_id = 0;
        }
    ?>
    <?= Html::activeHiddenInput($model, 'type', ['value'=>$form_type]) ?>
    <?= Html::activeHiddenInput($model, 'tour_id', ['value'=>$tour_id]) ?>

    <?= !in_array('tour_code', $form_fields) ? '' : Html::activeHiddenInput($model, 'tour_code', ['value'=>$tour_code]) ?>

    <?= !in_array('tour_name', $form_fields) ? '' : Html::activeHiddenInput($model, 'tour_name', ['value'=>$tour_name]) ?>

    <?= !in_array('subject_program', $form_fields) ? '' : $form->field($model, 'subject_program')->textInput(['maxlength' => true]) ?>

    <?= !in_array('participants_number', $form_fields) ? '' : $form->field($model, 'participants_number')->textInput(['maxlength' => true]) ?>

    <?= !in_array('purpose_trip', $form_fields) ? '' : $form->field($model, 'purpose_trip')->textInput(['maxlength' => true]) ?>

    <?= !in_array('number_participants', $form_fields) ? '' : $form->field($model, 'number_participants')->textInput(['maxlength' => true]) ?>

    <?php if(in_array('arrival_date', $form_fields)) { ?>
        <div class="required">
            <label class="control-label" for=""><?=Yii::t('app','Start date and city')?> </label>
            <table width="100%">
                <tr>
                    <td width="50%" valign="top">
                        <?= $form->field($model, 'arrival_date')->textInput(['maxlength' => true, 'placeholder' =>Yii::t('app','Date') ])->label(false) ?>
                    </td>
                    <td width="50%" valign="top">
                        <?= $form->field($model, 'arrival_city')->dropDownList([ 'Beijing' => 'Beijing', 'Shanghai' => 'Shanghai', 'Guangzhou' => 'Guangzhou', 'Hongkong' => 'Hongkong', 'Other' => 'Other', ], ['prompt' => Yii::t('app','City')])->label(false) ?>
                    </td>
                </tr>
            </table>
        </div>
        <?php if(in_array('departure_date', $form_fields)) { ?>
            <label class="control-label" for=""><?=Yii::t('app','Departure (In China)')?> </label>
            <table width="100%">
                <tr>
                    <td width="50%" valign="top">
                        <?= $form->field($model, 'departure_date')->textInput(['maxlength' => true, 'placeholder' =>Yii::t('app','Date') ])->label(false) ?>
                    </td>
                    <td width="50%" valign="top">
                        <?= $form->field($model, 'departure_city')->dropDownList([ 'Beijing' => 'Beijing', 'Shanghai' => 'Shanghai', 'Guangzhou' => 'Guangzhou', 'Hongkong' => 'Hongkong', 'Other' => 'Other', ], ['prompt' => Yii::t('app','City')])->label(false) ?>
                    </td>
                </tr>
            </table>
        <?php } ?>
    <?php } ?>

    <?php if(in_array('tour_length', $form_fields)) { ?>
    <div class="required">
        <label class="control-label" for=""><?= $form_type==FORM_TYPE_EDU? Yii::t('app','Duration') : Yii::t('app','Duration')?></label>
        <table width="100%">
            <tr>
                <td width="50%" valign="middle">
                    <?= $form->field($model, 'tour_length')->dropDownList([ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '>20' => '>20', ], ['prompt' => ''])->label(false) ?>
                </td>
                <td width="50%" valign="middle">
                    <label class="desc-label"><?=Yii::t('app','Day(s)')?></label>
                </td>
            </tr>
        </table>
    </div>
    <?php } ?>

    <?= !in_array('ideas', $form_fields) ? '' : $form->field($model, 'ideas')->textarea(['maxlength' => true, 'rows'=>3, 'placeholder' => Yii::t('app','Please provide us with as much detail as possible, for example, the cities you want to visit and any classes or activities you want to participate in')]) ?>

    <?= !in_array('ideas_trip', $form_fields) ? '' : $form->field($model, 'ideas_trip')->textarea(['maxlength' => true, 'rows'=>2, 'placeholder' => '']) ?>

    <?php if(in_array('adults', $form_fields)) { ?>
    <div class="required">
        <label class="control-label" for=""><?=Yii::t('app','Number of travelers')?></label>
        <table width="100%">
            <tr>
                <td width="50%" valign="middle">
                    <?= $form->field($model, 'adults')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15', 16 => '16', 17 => '17', 18 => '18', 19 => '19', 20 => '20', ], ['prompt' => ''])->label(false) ?>
                </td>
                <td width="50%" valign="middle">
                    <label class="desc-label"><?=Yii::t('app','Adults (> 12 yrs)')?></label>
                </td>
            </tr>
            <?php if(in_array('children', $form_fields)) { ?>
            <tr>
                <td width="50%" valign="middle">
                    <?= $form->field($model, 'children')->dropDownList([ 0 => '', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15', 16 => '16', 17 => '17', 18 => '18', 19 => '19', 20 => '20', ])->label(false) ?>
                </td>
                <td width="50%" valign="middle" class="control-label">
                    <label class="desc-label"><?=Yii::t('app','Children (2 - 12 yrs)')?></label>
                </td>
            </tr>
            <?php } ?>
            <?php if(in_array('infants', $form_fields)) { ?>
            <tr>
                <td width="50%" valign="middle">
                    <?= $form->field($model, 'infants')->dropDownList([ 0 => '', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15', 16 => '16', 17 => '17', 18 => '18', 19 => '19', 20 => '20', ])->label(false) ?>
                </td>
                <td width="50%" valign="middle" class="control-label">
                    <label class="desc-label"><?=Yii::t('app','Infants (< 2 yrs)')?></label>
                </td>
            </tr>
            <?php } ?>
            <?php if (in_array('guest_information', $form_fields)) { ?>
                <tr>
                    <td colspan="2">
                        <?= $form->field($model, 'guest_information')->textarea(['maxlength' => true, 'rows'=>3, 'placeholder' => Yii::t('app','Please let us know if someone needs particular assistance in your group. Please tell us children\'s height for a possible discount.')])->label(false) ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php } ?>

    <?= !in_array('transport_info', $form_fields) ? '' : $form->field($model, 'transport_info')->textarea(['maxlength' => true, 'rows'=>2, 'placeholder' => '']) ?>

    <?= !in_array('other_info', $form_fields) ? '' : $form->field($model, 'other_info')->textarea(['maxlength' => true, 'rows'=>2, 'placeholder' => '']) ?>

    <?= !in_array('book_hotels', $form_fields) ? '' : $form->field($model, 'book_hotels')->dropDownList([ 'Yes' => Yii::t('app','Yes'), 'No' => Yii::t('app','No'), ], ['prompt' => Yii::t('app','')]) ?>

    <?php if(in_array('hotel_preferences', $form_fields)) {?>
    <div class="form-group field-forminfo-hotel_preferences required">
    <label class="control-label" for="forminfo-hotel_preferences"><?= Yii::t('app','Hotel preferences') ?></label>
    <?= $form->field($model, 'hotel_preferences')->dropDownList([ '3 star or equal' => Yii::t('app','3 star or equal'), '4 star or equal' => Yii::t('app','4 star or equal'), '5 star or equal' => Yii::t('app','5 star or equal'), ], ['prompt' => ''])->label(false) ?>
    </div>
    <?php } ?>

    <?= !in_array('room_requirements', $form_fields) ? '' : $form->field($model, 'room_requirements')->textarea(['maxlength' => true, 'rows'=>2, 'placeholder' => Yii::t('app','Please let us know how many and what types of rooms you want, as well as other requirements.')]) ?>

    <?= !in_array('group_type', $form_fields) ? '' : $form->field($model, 'group_type')->dropDownList([ 'Family' => Yii::t('app','Family'), 'Couple' => Yii::t('app','Couple'), 'Friends' => Yii::t('app','Friends'), 'Business' => Yii::t('app','Business'), 'Solo' => Yii::t('app','Solo'), 'Other' => Yii::t('app','Other'), ], ['prompt' => Yii::t('app','')]) ?>

    <?php if(in_array('cities_plan', $form_fields)) { ?>
    <div class="form-group field-forminfo-cities_plan">
        <label class="control-label"><?= Yii::t('app','Destinations that you plan to visit') ?></label>
        <input type="hidden" name="FormInfo[cities_plan]" value="">
        <div id="forminfo-cities_plan">
            <?php
              $popular_cities_name = [];
              foreach (\common\models\Tools::getFormPopularCities() as $key => $city_name) { ?>
                <label><input type="checkbox" name="FormInfo[cities_plan][]" value="<?=$city_name?>" <?=(isset($current_city_name)&&($current_city_name==$city_name))?'checked':'' ?> > <?=$city_name?></label>
                
            <?php $popular_cities_name[] = $city_name;} 
                $current_city_in_list = 1;
                if (isset($current_city_name) && !in_array($current_city_name, $popular_cities_name)) 
                {
                    $current_city_in_list = 0;
                }
            ?>
            <label><input type="checkbox" id="ck_other_city" value="Other" <?=(!$current_city_in_list&&isset($current_city_name))?'checked':'' ?>> <?= Yii::t('app','Other') ?></label>
            <label id="lab_other_city" <?=(!$current_city_in_list&&isset($current_city_name))?'':'style="display: none;"' ?>><input type="input" name="FormInfo[cities_plan][]" value="<?=(!$current_city_in_list&&isset($current_city_name))?$current_city_name:'' ?>" <?=(!$current_city_in_list&&isset($current_city_name))?'':'disabled="disabled"' ?> style="width: 200px"></label>
        </div>

        <div class="help-block"></div>
    </div>
    <?php } ?>

    <?= !in_array('travel_interests', $form_fields) ? '' : $form->field($model, 'travel_interests')->checkboxList(['Chinese Culture' => Yii::t('app','Chinese Culture'),'Adventure' => Yii::t('app','Adventure'),'Nature' => Yii::t('app','Nature'),'Chinese food' => Yii::t('app','Chinese food'),'Romance' => Yii::t('app','Romance'),]) ?>

    <?= !in_array('prefered_budget', $form_fields) ? '' : $form->field($model, 'prefered_budget')->dropDownList([ 'Below 1499 USD' => Yii::t('app','Below 1499 USD'), '1500 to 2999 USD' => Yii::t('app','1500 to 2999 USD'), '3000 to 4999 USD' => Yii::t('app','3000 to 4999 USD'), 'Above 5000 USD' => Yii::t('app','Above 5000 USD'), ], ['prompt' => Yii::t('app','')]) ?>

    <?= !in_array('additional_information', $form_fields) ? '' : $form->field($model, 'additional_information')->textarea(['maxlength' => true, 'rows'=>2, 'placeholder' => '']) ?>

    <?php if(in_array('name', $form_fields)) { ?>
    <div class="required">
        <label class="control-label" for=""><?=Yii::t('app','Your full name')?></label>
        <table width="100%">
            <tr>
                <td width="30%" valign="top">
                    <?= $form->field($model, 'name_prefix')->dropDownList([ 'Mr.' => Yii::t('app','Mr.'), 'Mrs.' => Yii::t('app','Mrs.'), 'Miss' => Yii::t('app','Miss'), 'Other'=>Yii::t('app','Other')], ['prompt' => ''])->label(false) ?>
                </td>
                <td width="70%" valign="top">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
                </td>
            </tr>
        </table>
    </div>
    <?php } ?>

    <?= !in_array('email', $form_fields) ? '' : $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= !in_array('school_name', $form_fields) ? '' : $form->field($model, 'school_name')->textInput(['maxlength' => true]) ?>

    <?= !in_array('company_name', $form_fields) ? '' : $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= !in_array('position', $form_fields) ? '' : $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
    
    <?= !in_array('nationality', $form_fields) ? '' : $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= !in_array('skype_name', $form_fields) ? '' : $form->field($model, 'skype_name')->textInput(['maxlength' => true]) ?>

    <?= !in_array('phone_number', $form_fields) ? '' : $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= !in_array('hear_about_us', $form_fields) ? '' : $form->field($model, 'hear_about_us')->textInput(['maxlength' => true]) ?>

    <?= !in_array('promotion_code', $form_fields) ? '' : $form->field($model, 'promotion_code')->textInput(['maxlength' => true]) ?>

    <?= !in_array('prefered_travel_agent', $form_fields) ? '' : $form->field($model, 'prefered_travel_agent')->dropDownList([ 'English' => 'English', 'Français' => 'Français', 'Español' => 'Español', 'Deutsch' => 'Deutsch', ], ['prompt' => '']) ?>

    <div class="form-group bt-submit">
        <?php if(isset($bt_submit_txt)) {?>
            <?= Html::submitButton($bt_submit_txt, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php } else { ?>
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Submit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    var form_msg_required = "<?=Yii::t('app','Required')?>";
</script>

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
                $('#form-info-form').yiiActiveForm('add', {
                    id: 'hotel_preferences',
                    name: 'hotel_preferences',
                    container: '.field-forminfo-hotel_preferences',
                    input: '#forminfo-hotel_preferences',
                    error: '.help-block',
                    validate:  function (attribute, value, messages, deferred, form) {
                        yii.validation.required(value, messages, {message: form_msg_required});
                    }
                });
            }
            else{
                $('.field-forminfo-hotel_preferences').hide();
                $('.field-forminfo-room_requirements').hide();
                $('#form-info-form').yiiActiveForm('remove', 'hotel_preferences');
            }
        });
        $('#ck_other_city').click(function(){
            if(this.checked){
                $('#lab_other_city').show().children("input").removeAttr('disabled');

            }
            else{
                $('#lab_other_city').hide().children("input").attr('disabled','disabled');
            }
        });
    });
JS;
$this->registerJs($js);
?>
