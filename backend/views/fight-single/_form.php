<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
    $form = ActiveForm::begin();
?>

<?= $form->field($model, 'name')?>
<?= $form->field($model, 'thumb')?>
<?= $form->field($model, 'price')?>
<?= $form->field($model, 'discount')?>
<?= $form->field($model, 'member_count')?>

<?= $form->field($model, 'content')?>

<?= Html::submitButton('提交保存', ['class' => 'btn btn-block btn-success'])?>
<?php
    ActiveForm::end();
?>
