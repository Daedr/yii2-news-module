<?php

use common\modules\news\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление новостями';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <p>
        <?= Html::a('Добавить новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'table-responsive'],
            'columns' => [
                'id',
                [
                    'attribute' => 'category_id',
                    'filter' => Category::find()->select('name')->indexBy('id')->column(),
                    'value' => 'category.name',
                ],
                'title',
                'preview',
                'content:ntext',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

</div>
