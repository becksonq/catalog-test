<?php

use yii\helpers\Html;

?>

<footer class="text-muted fixed-bottom pt-3" style="background-color: #e3f2fd;">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>