<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '拼团管理';
?>

<section class="wrapper">
    <h2><?= $this->title?></h2>
    <?= Html::a('新建商品', ['/fight-single/create'], ['class' => 'btn btn-success', 'style' => 'margin-bottom: 20px']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'member_count',
            'discount',
            'created_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn'
            ]
        ]
    ])?>
</section>
