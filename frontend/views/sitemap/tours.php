<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tours - The China Guide</title>
    <script src="/statics/js/jquery.min.js"></script>
    <style type="text/css">
        .title-bar{
            background-color: #eee;
            cursor:pointer;
            padding: 10px 5px;
            margin: 10px 0;
            font-weight: bold;
            font-size: 16px;
        }
        .sub-title{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <ul>
    <?php foreach ($data['tours'] as $value) { 
        $url_prefix = 'experience';
        if ($value['type'] == TOUR_TYPE_GROUP) {
            $url_prefix = 'join-a-group';
        }

    ?>
        <li>
            <div class="title-bar"><?= $value['code'] ?> <a href="<?= $site_root ?><?= Url::toRoute([$url_prefix.'/view', 'url_id'=>$value['url_id']]) ?>"><?= $value['name'] ?></a> (<?= ($value['tour_length']==intval($value['tour_length']))?intval($value['tour_length']):$value['tour_length'] ?> <?=($value['tour_length']>1)?'days':'day'?>, <?= $value['display_cities'] ?>)</div>
            <ul style="display: none;">
                <?php foreach ($value['itineraries'] as $day_item) { ?>
                <li>
                    <div class="sub-title">Day <?=$day_item['day']?>: <?=$day_item['cities_name']?></div>
                    <div><?=$day_item['description']?></div>
                </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
    </ul>

</body>
<script type="text/javascript">
    $(function(){
        $('.title-bar').click(function() {
            $(this).parent('li').children('ul').toggle();
        });
    });
</script>
</html>
