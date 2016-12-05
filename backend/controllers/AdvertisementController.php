<?php
namespace backend\controllers;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class AdvertisementController extends ArticleController
{
    public $article_type = ARTICLE_TYPE_ADVERTISEMENT;
}
