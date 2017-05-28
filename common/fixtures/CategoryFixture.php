<?php


namespace common\fixtures;


use yii\test\ActiveFixture;

class CategoryFixture extends ActiveFixture
{
    public $modelClass = 'common\modules\news\models\Category';
    public $dataFile = __DIR__ . '/data/category.php';
}