<?php
/**
 * Created by PhpStorm.
 * User: xin
 * Date: 17/12/13
 * Time: 下午1:06
 */
namespace backend\controllers;

use Yii;
use common\models\Domain;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DomainController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Domain::find()
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Domain();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->batchSave()) {
                Yii::$app->session->setFlash('success', '保存成功');
            } else {
                Yii::$app->session->setFlash('error', '保存失败');
            }

            return $this->redirect('/domain/index');
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

            return $this->redirect('/domain/index');
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

        return $this->redirect('/domain/index');
    }

    public function findModel($id)
    {
        if (($model = Domain::findOne($id)) == null) {
            throw new NotFoundHttpException();
        }

        return $model;
    }
}