<?php

namespace app\models;
use yii\db\ActiveRecord;

class RoutesTours extends ActiveRecord
{

  /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RoutesTours';
    }
}
