<?php
namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class FightSingleOrder extends ActiveRecord
{
    public static function tableName()
    {
        return 'fight_single_order';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at']
                ],
            ],
        ];
    }

    public function rules()
    {
        return [
            [['good_id'], 'required'],
            [['good_id', 'created_at'], 'integer']
        ];
    }
}