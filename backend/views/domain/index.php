<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '域名管理';
?>

<section class="wrapper">
    <h2><?= $this->title?></h2>
    <?= Html::a('导入域名', ['/domain/create'], ['class' => 'btn btn-success', 'style' => 'margin-bottom: 20px']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'domain',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->getStatus();
                }
            ],
            [
                'attribute' => 'closed_at',
                'value' => function ($model) {
                    if ($model->closed_at == 0) {
                        return $model->getStatus();
                    } else {
                        return date('Y-m-d H:i:s', $model->closed_at);
                    }
                }
            ],
            'created_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn'
            ]
        ]
    ])?>
</section>
