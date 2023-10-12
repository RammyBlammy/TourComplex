<?php

namespace app\models;

use yii\db\ActiveRecord;


class CategoryTours extends ActiveRecord
{

  /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoryTours';
    }
}
