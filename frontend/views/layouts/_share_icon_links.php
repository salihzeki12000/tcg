   <div class="social-share-links col-lg-12 col-md-12 col-sm-12 col-xs-12">
   
    <span class="share-title <?=(empty($title_image_url))?'width-sort':'' ?>"><?=Yii::t('app','Share')?>:</span>
    <?php $encode_this_url = urlencode(SITE_BASE_URL.$_SERVER['REQUEST_URI']); ?>
    <a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=$encode_this_url?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"></a>
    <a class="share-twitter" href="http://twitter.com/share?url=<?=$encode_this_url?>&amp;text=<?=urlencode($this->title)?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"></a>

    <?php if(!empty($title_image_url)) { ?>
    <a class="share-pinterest" href="https://www.pinterest.com/pin/create/button/?url=<?=$encode_this_url?>&media=<?=$title_image_url?>&description=<?=urlencode($this->title.', '.$this->description)?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"></a>
    <?php } ?>

    <a class="share-googleplus" href="https://plus.google.com/share?url=<?=$encode_this_url?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"></a>
    <a class="share-mail" href="mailto:?subject=<?=urlencode($this->title)?>&amp;body=<?=$encode_this_url?>"></a>
   </div>
