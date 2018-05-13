<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_test_response".
 *
 * @property int $id
 * @property int $user_test_id
 * @property int $answer
 * @property int $question_id
 *
 * @property UserTest $userTest
 * @property Question $question
 */
class UserTestResponse extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_test_response';
    }

    /**
     * @param Question $question
     * @return UserTestResponse
     */
    public static function createOfQuestion(Question $question)
    {
        $instance = new self();
        $instance->question_id = $question->id;

        return $instance;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_test_id'], 'required'],
            [['user_test_id', 'answer', 'question_id'], 'integer'],
            [
                ['user_test_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => UserTest::class,
                'targetAttribute' => ['user_test_id' => 'id']
            ],
            [
                ['question_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Question::class,
                'targetAttribute' => ['question_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'answer' => 'Ответ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTest()
    {
        return $this->hasOne(UserTest::class, ['id' => 'user_test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::class, ['id' => 'question_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserTestResponseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserTestResponseQuery(get_called_class());
    }
}
