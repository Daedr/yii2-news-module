<?php

/* @var $this yii\web\View */
/* @var yii\data\ActiveDataProvider $dataProvider */
/* @var \common\modules\news\models\Category $modelCategory */
/* @var \common\modules\news\models\News $modelNews */


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

    <div class="row">
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false,
            'options' => [
                'id'     => 'filter-form',
                'action' => ['index'],
                'method' => 'get',
            ]
        ]); ?>
        <div class="col-md-3">
            <?php echo $form
                ->field($modelCategory, 'name')
                ->dropDownList(
                    Category::find()->select(['name', 'id'])->indexBy('id')->column(),
                    ['id'=>'category','prompt'=>'Все']
                )
            ?>
        </div>

        <div class="col-md-3">
            <?php echo $form
                ->field($modelNews, 'date')
                ->dropDownList(
                    $modelNews->getAvailableYears(),
                    ['id'=>'year', 'prompt'=>'Все']
                )
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

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
