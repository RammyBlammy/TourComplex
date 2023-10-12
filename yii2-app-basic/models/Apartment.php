<?php

namespace app\models;

use yii\db\ActiveRecord;

class Apartment extends ActiveRecord
{

  /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Apartment';
    }

    public function getTypeRoom(){
        return $this->hasOne(TypeRoom::class, ["id"=>"type"]);
    }

    public function getRooms(){
        return $this->hasMany(Room::class,["idApart"=>"id"]);
    }

    public function isFree($dateIn, $dateOut){
        $rooms = $this->rooms;
        $dateIn = strtotime($dateIn);
        $dateOut = strtotime($dateOut);
        $rooms_fill = [];
        foreach($rooms as $room){
            $roomIn = strtotime($room->dateIn);
            $roomOut = strtotime($room->dateOut);
            if(($dateIn > $roomIn && $dateIn < $roomOut) || ($dateOut < $roomOut && $dateOut > $roomIn) || ($dateIn < $roomIn && $dateOut > $roomOut)){
                $rooms_fill[] = $room;
            }
        };
        return count($rooms_fill) == 0;
    }
}
