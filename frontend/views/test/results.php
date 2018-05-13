<?php

/**
 * @var $this \yii\web\View
 * @var \common\models\Test $test
 * @var int $max
 * @var int $score
 */

$this->registerCss(/** @lang CSS */
    "
.container-result {
    padding: 15px;
}
");

?>
<h1>Результаты теста</h1>
<div class="container-result">
    <h3>Предмет: <?= $test->discipline->name ?></h3>
    <h3>Тема: <?= $test->name ?></h3>
    <h3>Оценка: <?= $score ?></h3>
    <h3>Всего вопросов: <?= $max ?></h3>
</div>
