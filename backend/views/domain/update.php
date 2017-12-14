<?php
    $this->title = '修改域名';
?>

<section class="wrapper">
    <h3><?= $this->title?></h3>
    <?=
        $this->render('_form', [
            'model' => $model
        ]);
    ?>
</section>