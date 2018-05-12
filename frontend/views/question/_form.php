<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Question */
/* @var $form yii\bootstrap\ActiveForm */

$model->correct_option = 1; //preselect first variant

?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textarea([
        'rows' => 2,
        'placeholder' => 'Условие...',
    ])->label(false) ?>

    <table width="100%">
        <tr>
            <td width="25px">A. <?= $form->field($model, 'correct_option')->radio([
                    'value' => 1,
                    'checked'
                ], false)->label(false) ?></td>
            <td><?= $form->field($model, 'option1')
                    ->textInput(['placeholder' => 'Первый вариант ответа...'])
                    ->label(false) ?></td>
        </tr>
        <tr>
            <td width="25px">B. <?= $form->field($model, 'correct_option')->radio([
                    'value' => 2,
                    'uncheck' => null
                ], false)->label(false) ?></td>
            <td><?= $form->field($model, 'option2')
                    ->textInput(['placeholder' => 'Второй вариант ответа...'])
                    ->label(false) ?></td>
        </tr>
        <tr>
            <td width="25px">C. <?= $form->field($model, 'correct_option')->radio([
                    'value' => 3,
                    'uncheck' => null
                ], false)->label(false) ?></td>
            <td><?= $form->field($model, 'option3')
                    ->textInput(['placeholder' => 'Третий вариант ответа...'])
                    ->label(false) ?></td>
        </tr>
        <tr>
            <td width="25px">D. <?= $form->field($model, 'correct_option')->radio([
                    'value' => 4,
                    'uncheck' => null
                ], false)->label(false) ?></td>
            <td><?= $form->field($model, 'option4')
                    ->textInput(['placeholder' => 'Четвертый вариант ответа...'])
                    ->label(false) ?></td>
        </tr>
    </table>
    <p><sup style="color: red">*</sup>Отметьте правильный вариант ответа</p>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Готово', Url::to(['test/view', 'id' => $model->test_id]), [
            'class' => 'btn btn-primary',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
