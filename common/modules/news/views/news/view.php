<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\news\models\News */

$this->title = Html::encode($model->title);
$this->params['breadcrumbs'][] = $this->title;

?>
<article class="news-view">
    <div class="panel panel-default">
        <div class="panel-heading">
            <p>
                <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                <span class="label label-default"><?= $model->date ?></span>
            </p>
            <h2><?= $this->title ?></h2>
            <p><span class="label label-primary"><?= $model->category->name ?></span></p>
        </div>
        <div class="panel-body">
            <div class="news-content">
                <?= $model->content ?>
            </div>
        </div>
    </div>
</article>
