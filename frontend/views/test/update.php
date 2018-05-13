<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Test */
/* @var $disciplineNames string[] */

$this->title = 'Редактировать тест: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="test-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'disciplineNames' => $disciplineNames,
    ]) ?>

</div>
