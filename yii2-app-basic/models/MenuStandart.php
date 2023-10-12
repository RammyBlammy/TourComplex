<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


class menuStandart extends ActiveRecord
{

  /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menuStandart';
    }

    public function getFood(){
        return $this->hasOne(Food::class, ["id"=>"foodId"]);
    }
}
