<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property int $test_id
 * @property string $text
 * @property string $option1
 * @property string $option2
 * @property string $option3
 * @property string $option4
 * @property int $correct_option
 *
 * @property Test $test
 */
class Question extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['option1', 'option2', 'option3', 'option4', 'correct_option'],
                'required',
                'message' => '{attribute} не должен быть пустым.'
            ],
            [['text'], 'required', 'message' => '{attribute} не должно быть пустым.'],
            [['test_id', 'correct_option'], 'integer'],
            [['text', 'option1', 'option2', 'option3', 'option4'], 'string'],
            [
                ['test_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Test::class,
                'targetAttribute' => ['test_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'text' => 'Условие',
            'option1' => 'Первый вариант ответа',
            'option2' => 'Второй вариант ответа',
            'option3' => 'Третий вариант ответа',
            'option4' => 'Четвертый вариант ответа',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::class, ['id' => 'test_id']);
    }

    /**
     * {@inheritdoc}
     * @return QuestionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionQuery(get_called_class());
    }
}
