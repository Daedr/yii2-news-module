<?php


namespace common\fixtures;


use yii\test\ActiveFixture;

class NewsFixture extends ActiveFixture
{
    public $modelClass = 'common\modules\news\models\News';
    public $dataFile = __DIR__ . '/data/news.php';
}