<?php

namespace app\models;

use yii\db\ActiveRecord;

class RelationTourCategory extends ActiveRecord
{

  /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RelationTourCategory';
    }

    public function getCategoryTours(){
        return $this->hasOne(CategoryTours::class, ["id"=>"categoryId"]);
    }
}
