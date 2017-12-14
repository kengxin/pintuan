<?php
namespace frontend\controllers;

use common\models\Domain;
use Yii;
use common\models\FightSingleOrder;
use common\models\FightSingleOrderChildren;
use common\models\FightSingleGoods;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class FightSingleController extends Controller
{
    public $layout = false;

    public $enableCsrfValidation = false;

    public function actionGood($id)
    {
        $model = $this->findGoods($id);

        $goodsList = FightSingleGoods::find()
            ->where(['<>', 'id', $model->id])
            ->limit(6)
            ->all();

        return $this->render('good',[
            'model' => $model,
            'goodsList' => $goodsList
        ]);
    }

    public function actionProcessing($order_id)
    {
        if (empty($_SERVER['HTTP_REFERER'])) {
            $domain = Domain::getRedirectDomain();
            header("Location: http://{$domain}{$_SERVER['REQUEST_URI']}");
        }

        $order_id = intval($order_id);
        $orderInfo = FightSingleOrder::findOne($order_id);
        if (empty($orderInfo)) {
            throw new NotFoundHttpException();
        }

        $childrenInfo = FightSingleOrderChildren::find()
            ->where(['pid' => $order_id])
            ->orderBy('id ASC')
            ->all();
        $goodInfo = $this->findGoods($orderInfo->good_id);
        $lastCount = $goodInfo->member_count - count($childrenInfo);

        $goodsList = FightSingleGoods::find()
            ->where(['<>', 'id', $goodInfo->id])
            ->limit(6)
            ->all();

        return $this->render('processing', [
            'order_id' => $order_id,
            'goodInfo' => $goodInfo,
            'goodsList' => $goodsList,
            'lastCount' => $lastCount,
            'childrenInfo' => $childrenInfo
        ]);
    }

    public function actionRules()
    {
        return $this->render('rules');
    }

    public function actionSaveOrder()
    {
        $good_id = Yii::$app->request->post('good_id', false);
        $pid = Yii::$app->request->post('pid', false);
        $username = Yii::$app->request->post('username', false);
        $tel = Yii::$app->request->post('tel', false);

        if (!FightSingleGoods::find()->where(['id' => $good_id])->exists()) {
            return json_encode([
                'code' => -1,
                'err' => '服务器错误'
            ]);
        }

        $fightSingleOrderChildren = new FightSingleOrderChildren();
        if ($fightSingleOrderChildren->saveChildren($good_id, $username, $tel, $pid)) {
            return json_encode([
                'code' => 0,
                'order_id' => $fightSingleOrderChildren->pid
            ]);
        } else {
            return json_encode([
                'code' => -1,
                'err' => '服务器错误'
            ]);
        }
    }

    public function actionSetCookie()
    {
        $pathInfo = parse_url($_SERVER['HTTP_REFERER']);
        $order_id = Yii::$app->request->post('order_id', null);
        if ($order_id == null) {
            return false;
        }

        $cookies = Yii::$app->response->cookies;

        $cookies->add(new \yii\web\Cookie([
            'name' => "order_{$order_id}",
            'value' => '1',
            'expire'=>time() + 86400 * 30
        ]));

        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Origin: http://{$pathInfo['host']}");
        return json_encode([
            'code' => 0
        ]);
    }

    public function actionGetCookie()
    {
        $pathInfo = parse_url($_SERVER['HTTP_REFERER']);
        $order_id = Yii::$app->request->get('order_id', null);
        if ($order_id == null) {
            return false;
        }

        $cookies = Yii::$app->request->cookies;

        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Origin: http://{$pathInfo['host']}");

        return json_encode([
            'code' => 0,
            'is_join' => empty($cookies->get("order_{$order_id}")) ? 0 : 1
        ]);
    }

    public function findGoods($id)
    {
        $id = intval($id);
        if (($model = FightSingleGoods::findOne($id)) == null) {
            throw new NotFoundHttpException();
        }

        return $model;
    }
}