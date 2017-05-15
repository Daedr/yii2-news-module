<?php

namespace common\modules\news\models;

use yii\base\Model;

class Years extends Model
{
    public $id;

    public function attributes()
    {
        return ['id'];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Год',
        ];
    }

    /**
     * @param int $last  how many years should include from now
     * @return array
     */
    public function getYearArray($last=5)
    {
        $year = (int) date('Y');
        $list = [];
        for ($i=0; $i<=$last; $i++) {
            $value = $year - $i;
            $list[$value] = $value;
        }
        return $list;
    }
}
