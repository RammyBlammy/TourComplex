<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


class menuPlus extends ActiveRecord
{

  /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menuPlus';
    }

    public function getFood(){
        return $this->hasOne(Food::class, ["id"=>"foodId"]);
    }
}
