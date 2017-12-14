<?php
    $this->title = '新建商品';
?>

<section class="wrapper">
    <h3><?= $this->title?></h3>
    <?=
        $this->render('_form', [
            'model' => $model
        ]);
    ?>
</section>