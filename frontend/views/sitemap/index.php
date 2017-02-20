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
</urlset>