<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

/* @var $exception Exception */
/* @var $oldTest \common\models\Test */
/* @var $newTestId int */

$this->title = $oldTest->name;
?>
<div class="site-error">

    <h1>В данный момент вы уже проходите тест "<?= $oldTest->name ?>"</h1>
    <p>
        Продолжить предыдущий тест или завершить его прохождение?
    </p>
    <p>
        <?= Html::a('Продолжить', ['test/pass', 'testId' => $oldTest->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Завершить', ['test/complete', 'nextTestId' => $newTestId], ['class' => 'btn btn-danger']) ?>
    </p>
</div>
