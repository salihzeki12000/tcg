<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Cities;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Experiences');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-index container">

    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs">
       <div class="file-preview-frame file-preview-initial" id="preview-1480902258105-init_0" data-fileindex="init_0" data-template="image">
        <div class="kv-file-content"> 
         <img src="http://www.demo.com/uploads/201611/29/583d509e48cda_s.jpg" class="kv-preview-data file-preview-image" title="P7278493.JPG" alt="P7278493.JPG" style="width:auto;height:160px;" /> 
        </div>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption" title="P7278493.JPG">
          P7278493.JPG 
          <br />
          <samp>(602.97 KB)</samp>
         </div> 
         <div class="file-thumb-progress hide">
          <div class="progress"> 
           <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
             0% 
           </div> 
          </div>
         </div> 
         <div class="file-actions"> 
          <div class="file-footer-buttons"> 
           <button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file" data-url="/uploaded-files/del-file-use" data-key="29"><i class="glyphicon glyphicon-trash text-danger"></i></button> 
          </div> 
          <span class="file-drag-handle drag-handle-init text-info" title="Move / Rearrange"><i class="glyphicon glyphicon-menu-hamburger"></i></span> 
          <div class="file-upload-indicator" title=""></div> 
          <div class="clearfix"></div> 
         </div> 
        </div> 
       </div> 
       <div class="file-preview-frame file-preview-initial" id="preview-1480902258105-init_1" data-fileindex="init_1" data-template="image">
        <div class="kv-file-content"> 
         <img src="http://www.demo.com/uploads/201611/29/583d509f4cb5a_s.jpg" class="kv-preview-data file-preview-image" title="P7288804_1.JPG" alt="P7288804_1.JPG" style="width:auto;height:160px;" /> 
        </div>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption" title="P7288804_1.JPG">
          P7288804_1.JPG 
          <br />
          <samp>(301.4 KB)</samp>
         </div> 
         <div class="file-thumb-progress hide">
          <div class="progress"> 
           <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
             0% 
           </div> 
          </div>
         </div> 
         <div class="file-actions"> 
          <div class="file-footer-buttons"> 
           <button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file" data-url="/uploaded-files/del-file-use" data-key="30"><i class="glyphicon glyphicon-trash text-danger"></i></button> 
          </div> 
          <span class="file-drag-handle drag-handle-init text-info" title="Move / Rearrange"><i class="glyphicon glyphicon-menu-hamburger"></i></span> 
          <div class="file-upload-indicator" title=""></div> 
          <div class="clearfix"></div> 
         </div> 
        </div> 
       </div> 
       <div class="file-preview-frame file-preview-initial" id="preview-1480902258105-init_2" data-fileindex="init_2" data-template="image">
        <div class="kv-file-content"> 
         <img src="http://www.demo.com/uploads/201611/29/583d50a01b262_s.jpg" class="kv-preview-data file-preview-image" title="P7308992.JPG" alt="P7308992.JPG" style="width:auto;height:160px;" /> 
        </div>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption" title="P7308992.JPG">
          P7308992.JPG 
          <br />
          <samp>(186.9 KB)</samp>
         </div> 
         <div class="file-thumb-progress hide">
          <div class="progress"> 
           <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
             0% 
           </div> 
          </div>
         </div> 
         <div class="file-actions"> 
          <div class="file-footer-buttons"> 
           <button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file" data-url="/uploaded-files/del-file-use" data-key="31"><i class="glyphicon glyphicon-trash text-danger"></i></button> 
          </div> 
          <span class="file-drag-handle drag-handle-init text-info" title="Move / Rearrange"><i class="glyphicon glyphicon-menu-hamburger"></i></span> 
          <div class="file-upload-indicator" title=""></div> 
          <div class="clearfix"></div> 
         </div> 
        </div> 
       </div> 
       <div class="file-preview-frame file-preview-initial" id="preview-1480902258105-init_3" data-fileindex="init_3" data-template="image">
        <div class="kv-file-content"> 
         <img src="http://www.demo.com/uploads/201611/29/583d50a0e8f5a_s.jpg" class="kv-preview-data file-preview-image" title="P7288759.JPG" alt="P7288759.JPG" style="width:auto;height:160px;" /> 
        </div>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption" title="P7288759.JPG">
          P7288759.JPG 
          <br />
          <samp>(464.91 KB)</samp>
         </div> 
         <div class="file-thumb-progress hide">
          <div class="progress"> 
           <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
             0% 
           </div> 
          </div>
         </div> 
         <div class="file-actions"> 
          <div class="file-footer-buttons"> 
           <button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file" data-url="/uploaded-files/del-file-use" data-key="32"><i class="glyphicon glyphicon-trash text-danger"></i></button> 
          </div> 
          <span class="file-drag-handle drag-handle-init text-info" title="Move / Rearrange"><i class="glyphicon glyphicon-menu-hamburger"></i></span> 
          <div class="file-upload-indicator" title=""></div> 
          <div class="clearfix"></div> 
         </div> 
        </div> 
       </div> 
      </div>
     </div> 
     <div class="clearfix"></div> 
     <div class="file-preview-status text-center text-success"></div> 
     <div class="kv-fileinput-error file-error-message" style="display: none;"></div> 
    </div>


    <div class="row">

        <div class="col-lg-12">
            <!-- <h1 class="page-header">Popular City Tours</h1> -->
        </div>


        <?php foreach ($tours as $tour) { ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 thumb">
            <div class="thumbnail">
                <img class="img-responsive" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>">
                <div class="carousel-caption">
                    <span>From $<?= $tour['price_usd'] ?> USD</span>
                </div>
                <div class="caption">
                    <p class="list-info"><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?> Days | <?= $tour['cities_count'] ?> Cities | <?= $tour['exp_num'] ?> Experiences</p>
                    <h3><?= $tour['name'] ?></h3>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>

</div>
