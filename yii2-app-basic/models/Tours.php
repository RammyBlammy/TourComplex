<?php

namespace app\models;

use yii\db\ActiveRecord;

class Tours extends ActiveRecord
{

  /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tours';
    }
}
