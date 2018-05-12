<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $discipline common\models\Discipline */
/* @var $relatedTests common\models\Test[] */

$this->title = $discipline->name;
$this->params['breadcrumbs'][] = ['label' => 'Disciplines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discipline-view">

    <!-- TODO :: !can() -->
    <?php if (!Yii::$app->getUser()->can('teacher')): ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $discipline->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $discipline->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <div class="jumbotron">
        <h1><?= Html::encode($discipline->name) ?></h1>
        <p><?= Html::encode($discipline->description) ?></p>
    </div>

    <?php foreach ($relatedTests as $test): ?>
        <?= Html::a($test->name, Url::to(['test/view', 'id' => $test->id])) ?>
    <?php endforeach; ?>
</div>
