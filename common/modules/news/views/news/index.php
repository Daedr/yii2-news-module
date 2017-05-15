<?php

/* @var $this yii\web\View */
/* @var yii\data\ActiveDataProvider $dataProvider */
/* @var \common\modules\news\models\Category $modelCategory */
/* @var \common\modules\news\models\Years $yearCategory */


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use common\modules\news\models\Category;
use yii\widgets\Pjax;

$this->title = 'Все новости';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="news-default-index">
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= Html::encode($this->title)  ?></h1>
        </div>
    </div>
    <?php $this->registerJs(
        "$(document).on('change', ['#category','#year'], function(e) {
            $.ajax({
                timeout: 2000,
                url: $('#filter-form').attr('action'),
                data: {categoryProvider: $('#category').val(), yearProvider: $('#year').val()},
                success:function(response) {
                    var updateData = $(response).find('#news-list');
                    $('#news-list').html(updateData); 
                }
            })
        })"
    ); ?>

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'options' => [
            'id'     => 'filter-form',
            'action' => ['index'],
            'method' => 'get',
        ]
    ]); ?>
    <?php echo $form
        ->field($modelCategory, 'name')
        ->dropDownList(
            ArrayHelper::map(Category::find()->asArray()->all(),'id','name'),
            ['id'=>'category', 'prompt'=>'Все']
        )
    ?>

    <?php echo $form
        ->field($modelYear, 'id')
        ->dropDownList(
            $modelYear->getYearArray(),
            ['id'=>'year', 'prompt'=>'Все']
        )
    ?>
    <?php ActiveForm::end(); ?>

    <?php Pjax::begin(); ?>

    <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'news-list',
        'itemView' => '_item',
        'summary' => 'Показано {count} из {totalCount}',
        'pager' => [
            'firstPageLabel' => 'Свежие',
            'lastPageLabel' => 'Последние',
        ],
    ]) ?>
    <?php Pjax::end(); ?>
</div>
</div>
