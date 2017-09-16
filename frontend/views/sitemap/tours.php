<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="robots" content="noindex">
    <title>Tours - The China Guide</title>
    <script src="/statics/js/jquery.min.js"></script>
    <style type="text/css">
        body{
            font-size: 14px;
        }
        .title-bar{
            background-color: #eee;
            cursor:pointer;
            padding: 10px 0;
            margin: 10px 0;
            font-weight: bold;
        }
        .sub-title{
            font-weight: bold;
        }
        ul,li,p{
            list-style-type:none;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
    <div>
    <?php foreach ($data['tours'] as $value) { 
        $url_prefix = 'experience';
        if ($value['type'] == TOUR_TYPE_GROUP) {
            $url_prefix = 'join-a-group';
        }

    ?>
        <div class="tour-item">
            <div class="title-bar"><?= $value['code'] ?> <a href="<?= $site_root ?><?= Url::toRoute([$url_prefix.'/view', 'url_id'=>$value['url_id']]) ?>"><?= $value['name'] ?></a> (<?= ($value['tour_length']==intval($value['tour_length']))?intval($value['tour_length']):$value['tour_length'] ?> <?=($value['tour_length']>1)?'days':'day'?>, <?= $value['display_cities'] ?>)</div>
            <div class="days" style="display: none;">
                <?php foreach ($value['itineraries'] as $day_item) { ?>
                <div>
                    <div class="sub-title">Day <?=$day_item['day']?>: <?=$day_item['cities_name']?></div>
                    <div><?=$day_item['description']?></div>
                </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    </div>

</body>
<script type="text/javascript">
    $(function(){
        $('.title-bar').click(function() {
            $(this).parent('.tour-item').children('.days').toggle();
        });
    });
</script>
</html>
