<?php
/**
 * Created by PhpStorm.
 * User: xin
 * Date: 17/12/13
 * Time: 下午1:06
 */
namespace backend\controllers;

use Yii;
use common\models\FightSingleGoods;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class FightSingleController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FightSingleGoods::find()
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new FightSingleGoods();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', '保存成功');
            } else {
                Yii::$app->session->setFlash('error', '保存失败');
            }

            return $this->redirect('/fight-single/index');
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', '修改成功');
            } else {
                Yii::$app->session->setFlash('error', '修改失败');
            }

            return $this->redirect('/fight-single/index');
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', '删除成功');
        } else {
            Yii::$app->session->setFlash('error', '删除失败');
        }

        return $this->redirect('/fight-single/index');
    }

    public function findModel($id)
    {
        if (($model = FightSingleGoods::findOne($id)) == null) {
            throw new NotFoundHttpException();
        }

        return $model;
    }
}