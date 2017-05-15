<?php

namespace common\modules\news\controllers;

use common\modules\news\models\Category;
use common\modules\news\models\News;
use common\modules\news\models\NewsSearch;
use common\modules\news\models\Years;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CRUD controller for the `news` module
 */
class NewsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Display all News
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex()
    {
        $modelSearch = new NewsSearch();
        $modelCategory = new Category();
        $modelYear = new Years();


        return $this->render('index', [
            'dataProvider' => $modelSearch->search(Yii::$app->request->get()),
            'modelCategory' => $modelCategory,
            'modelYear' => $modelYear,
        ]);
    }

    /**
     * Displays a single news model.
     * @param integer $id
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     * @throws \yii\base\InvalidParamException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
