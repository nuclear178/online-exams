<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_test".
 *
 * @property int $id
 * @property int $user_id
 * @property int $test_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $completed
 *
 * @property Test $test
 * @property User $user
 * @property UserTestResponse[] $responses
 */
class UserTest extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_test';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id', 'created_at', 'updated_at', 'completed'], 'integer'],
            [
                ['test_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Test::class,
                'targetAttribute' => ['test_id' => 'id']
            ],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id']
            ],
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(UserTestResponse::class, ['user_test_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $questions = $this->test->questions;
        foreach ($questions as $question) {
            $response = UserTestResponse::createOfQuestion($question);
            $response->user_test_id = $this->id;
            $response->save();
        }
    }

    /**
     * {@inheritdoc}
     * @return UserTestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserTestQuery(get_called_class());
    }

    /**
     * Returns true if completed, cancelled or timed out
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->completed === 1 || time() > $this->completionTime();
    }

    /**
     * Returns time before test must be completed
     * @return int
     */
    public function completionTime(): int
    {
        return $this->created_at + $this->test->durationMillis;
    }
}
