<?php

use yii\bootstrap4\Alert;

/* @var $this \yii\web\View */

foreach (Yii::$app->session->getAllFlashes() as $type => $message):
    if (in_array($type, ['success', 'danger', 'warning', 'info'])): ?>
        <?= Alert::widget([
            'options' => [
                'class' => 'alert alert-' . $type . ' fade show',
            ],
            'body'    => $message,
        ]) ?>
    <?php endif;
endforeach;

$this->registerJs('setTimeout(function(){$(".alert").fadeOut("slow")},3000);');
?>
