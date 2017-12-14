<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    $this->title = '导入域名';
?>

<section class="wrapper">
    <h3><?= $this->title?></h3>
    <?php
        $form = ActiveForm::begin();
    ?>
    <?= $form->field($model, 'domain')->textarea()?>

    <?= Html::submitButton('提交保存', ['class' => 'btn btn-block btn-success'])?>
    <?php
        ActiveForm::end();
    ?>
</section>