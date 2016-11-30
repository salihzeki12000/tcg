<?php
namespace backend\controllers;
require(dirname(__FILE__)."/ArticleController.php");

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class PreparationController extends ArticleController
{
    public $article_type = ARTICLE_TYPE_PREPARATION;
}
