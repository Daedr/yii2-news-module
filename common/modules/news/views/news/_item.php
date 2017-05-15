<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\news\models\News */

?>
<article>
    <div class="panel panel-default">
        <div class="panel-heading">
                <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                <span class="label label-default"><?= $model->date ?></span>
            <h4><?= $model->title ?></h4>
        </div>
        <div class="panel-body">
            <div class="preview">
                <?= $model->preview ?>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-6">
                    <?= Html::a('Подробнее...', ['view', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']) ?>
                </div>
            </div>
        </div>
    </div>
</article>
