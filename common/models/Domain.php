<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Domain extends ActiveRecord
{

    const STATUS_SUCCESS = 0;

    const STATUS_ERROR = 1;

    public static $statsList = [
        self::STATUS_SUCCESS => '域名正常',
        self::STATUS_ERROR => '域名异常'
    ];

    public static function tableName()
    {
        return 'domain';
    }

    public function rules()
    {
        return [
            [['domain'], 'required'],
            [['domain'], 'string'],
            [['status', 'created_at', 'closed_at'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'domain' => '域名',
            'status' => '状态',
            'closed_at' => '封禁时间',
            'created_at' => '创建时间'
        ];
    }

    public function batchSave()
    {
        $list = explode("\n", $this->domain);

        $time = time();
        $domainList = [];
        foreach ($list as $v) {
            if (strpos($v, 'http://') === 0) {
                $v = str_replace('http://', '', $v);
            }

            $domainList[] = [$v, self::STATUS_SUCCESS, $time];
        }

        $db = Yii::$app->db->createCommand();
        return $db->batchInsert(self::tableName(), ['domain', 'status', 'created_at'], $domainList)->execute();
    }

    public function getStatus()
    {
        return self::$statsList[$this->status];
    }

    public static function getRandDomain()
    {
        return Domain::find()
            ->select(['domain'])
            ->where(['status' => self::STATUS_SUCCESS])
            ->limit(10)
            ->orderBy('rand()')
            ->all();
    }

    public static function getRedirectDomain()
    {
        $domainInfo = Domain::find()
            ->where(['status' => self::STATUS_SUCCESS])
            ->limit(1)
            ->orderBy('rand()')
            ->one();

        return $domainInfo->domain;
    }

    public function setError()
    {
        $this->status = self::STATUS_ERROR;
        $this->closed_at = time();

        if ($this->save()) {
            Yii::$app->wechatMessage->sendWeChatMsg($this->domain);
        }

        return true;
    }
}