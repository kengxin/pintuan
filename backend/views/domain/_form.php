<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
    $form = ActiveForm::begin();
?>

<?= $form->field($model, 'domain')?>

<?= Html::submitButton('提交保存', ['class' => 'btn btn-block btn-success'])?>
<?php
    ActiveForm::end();
?>
