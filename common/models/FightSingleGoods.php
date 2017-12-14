<?php
namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class FightSingleGoods extends ActiveRecord
{
    public static function tableName()
    {
        return 'fight_single_goods';
    }

    public function rules()
    {
        return [
            [['name', 'thumb', 'price', 'discount', 'member_count', 'content'], 'required'],
            [['name', 'thumb', 'content'], 'string'],
            [['price', 'discount', 'member_count', 'created_at'], 'integer']
        ];
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

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名',
            'thumb' => '头图',
            'price' => '原价',
            'discount' => '拼团价',
            'member_count' => '开团人数',
            'content' => '内容',
            'created_at' => '创建时间'
        ];
    }

    public function getUrl()
    {
        $domainList = Domain::getRandDomain();
        $domainKey = array_rand($domainList, 1);

        return "http://{$domainList[$domainKey]->domain}/fight-single/good?id={$this->id}";
    }
}