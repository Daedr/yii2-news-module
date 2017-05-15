<?php

namespace common\modules\news\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * NewsSearch represents the model behind the search form about `common\modules\news\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['title', 'preview', 'content', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = News::find()->with('category');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);

        $this->load($params);

        $year = (int) ArrayHelper::getValue($params, 'yearProvider', 0);
        $this->category_id = ArrayHelper::getValue($params, 'categoryProvider', null);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'category_id' => $this->category_id,
        ]);

        if ($year) {
            $query->andFilterWhere([
                '=',
                new Expression('YEAR(DATE(`date`))'),
                $year
            ]);
        }

        $query->orderBy(['date'=>SORT_DESC]);

        return $dataProvider;
    }
}
