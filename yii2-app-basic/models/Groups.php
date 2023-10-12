<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */

class Groups extends ActiveRecord
{

  /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Groups';
    }

    public function getTours(){
        return $this->hasOne(Tours::class, ["id"=>"idT"]);
    }

    public function getStatuses(){
        return $this->hasOne(Statuses::class, ["id"=>"status"]);
    }

    public function getDateTours(){
        return $this->hasOne(DateTours::class, ["id"=>"idDate"]);
    }
}
