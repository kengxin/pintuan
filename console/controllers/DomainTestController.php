<?php
namespace console\controllers;

use common\models\Domain;
use yii\console\Controller;

class DomainTestController extends Controller
{
    const STATUS_SUCCESS = 0;
    const STATUS_ERROR = 2;

    public function actionIndex()
    {
        while(true){
            $domainList = Domain::find()
                ->where(['status' => Domain::STATUS_SUCCESS])
                ->all();

            foreach ($domainList as $domain) {
                if ($this->getDomainStatus($domain->domain) == self::STATUS_ERROR) {
                    $domain->setError();
                }
            }
        }
    }

    public function getDomainStatus($domain)
    {
        $url = "http://106.15.43.220:443/new.php?url={$domain}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $status = curl_exec($ch);

        curl_close($ch);

        return $status;
    }
}