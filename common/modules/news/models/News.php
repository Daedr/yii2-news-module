<?php

namespace common\modules\news\models;

use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $preview
 * @property string $content
 * @property string $date
 *
 * @property Category $category
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','preview','content'], 'required'],
            [['category_id'], 'integer'],
            [['content'], 'string'],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['preview'], 'string', 'max' => 200],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'title' => 'Название',
            'preview' => 'Краткое описание',
            'content' => 'Текст новости',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function afterFind()
    {
        $this->date = date('Y-m-d', strtotime($this->date));
        parent::afterFind();
    }
}
