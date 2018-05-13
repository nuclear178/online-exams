<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $discipline common\models\Discipline */
/* @var $relatedTests common\models\Test[] */

$this->title = $discipline->name;
$this->params['breadcrumbs'][] = ['label' => 'Предметы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discipline-view">

    <?php if (Yii::$app->getUser()->can('teacher')): ?>
        <p>
            <?= Html::a('Редактировать', ['update', 'id' => $discipline->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $discipline->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы действительно желаете удалить предмет? Все связанные тесты, а также результаты прохождения будут удалены',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Добавить тест', ['test/create', 'disciplineId' => $discipline->id],
                ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <div class="jumbotron">
        <h1><?= Html::encode($discipline->name) ?></h1>
        <p><?= Html::encode($discipline->description) ?></p>
    </div>

    <?php foreach ($relatedTests as $test): ?>
        <?= Html::a($test->name, Url::to(['test/view', 'id' => $test->id])) ?>
        <br>
    <?php endforeach; ?>
</div>
