<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserTestResponse */
/* @var $form ActiveForm */
?>
<div class="test-response_form">

    <?php $form = ActiveForm::begin(); ?>

    <div style="border: 1px solid gray; border-radius: 4px">
        <p><?= $model->question->text ?></p>

        <table width="100%">
            <tr>
                <td width="25px">A. <?= $form->field($model, 'answer')->radio([
                        'value' => 1,
                        'uncheck' => null
                    ], false)->label(false) ?></td>
                <td><?= $model->question->option1 ?></td>
            </tr>
            <tr>
                <td width="25px">B. <?= $form->field($model, 'answer')->radio([
                        'value' => 2,
                        'uncheck' => null
                    ], false)->label(false) ?></td>
                <td><?= $model->question->option2 ?></td>
            </tr>
            <tr>
                <td width="25px">C. <?= $form->field($model, 'answer')->radio([
                        'value' => 3,
                        'uncheck' => null
                    ], false)->label(false) ?></td>
                <td><?= $model->question->option3 ?></td>
            </tr>
            <tr>
                <td width="25px">D. <?= $form->field($model, 'answer')->radio([
                        'value' => 4,
                        'uncheck' => null
                    ], false)->label(false) ?></td>
                <td><?= $model->question->option4 ?></td>
            </tr>
        </table>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Ответить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- test-response_form -->
