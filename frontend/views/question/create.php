<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Question */
/* @var $numberOfQuestion int */


$this->title = "Добавить вопрос №$numberOfQuestion";
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить вопрос';
?>
<div class="question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
