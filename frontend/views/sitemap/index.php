<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($pages as $value) { ?>
    <url>
        <loc><?= $site_root ?><?= $value ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php } ?>
    <?php foreach ($data['tours'] as $value) { ?>
    <url>
        <loc><?= $site_root ?><?= Url::toRoute(['experience/view', 'url_id'=>$value['url_id']]) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($value['update_time'])) ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php } ?>
    <?php foreach ($data['group_tour'] as $value) { ?>
    <url>
        <loc><?= $site_root ?><?= Url::toRoute(['join-a-group/view', 'url_id'=>$value['url_id']]) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($value['update_time'])) ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php } ?>
    <?php foreach ($data['cities'] as $value) { ?>
    <url>
        <loc><?= $site_root ?><?= Url::toRoute(['destination/view', 'url_id'=>$value['url_id']]) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($value['update_time'])) ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $site_root ?><?= Url::toRoute(['destination/experiences', 'url_id'=>$value['url_id']]) ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $site_root ?><?= Url::toRoute(['destination/sights', 'url_id'=>$value['url_id']]) ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $site_root ?><?= Url::toRoute(['destination/activities', 'url_id'=>$value['url_id']]) ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php } ?>
    <?php foreach ($data['themes'] as $value) { ?>
    <url>
        <loc><?= $site_root ?><?= Url::toRoute(['experience/index', 'theme'=>$value['url_id']]) ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php } ?>
    <?php foreach ($data['sight'] as $value) { ?>
    <url>
        <loc><?= $site_root ?><?= Url::toRoute(['sight/view', 'url_id'=>$value['url_id']]) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($value['update_time'])) ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php } ?>
    <?php foreach ($data['activity'] as $value) { ?>
    <url>
        <loc><?= $site_root ?><?= Url::toRoute(['activity/view', 'url_id'=>$value['url_id']]) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($value['update_time'])) ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php } ?>
    <?php foreach ($data['faq'] as $value) { ?>
    <url>
        <loc><?= $site_root ?><?= Url::toRoute(['preparation/view', 'url_id'=>$value['url_id']]) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($value['update_time'])) ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php } ?>
    <?php foreach ($data['articles'] as $value) { ?>
    <url>
        <loc><?= $site_root ?><?= Url::toRoute(['article/view', 'url_id'=>$value['url_id']]) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($value['update_time'])) ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php } ?>
</urlset>