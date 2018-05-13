<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property int $discipline_id
 * @property int $author_id
 * @property string $name
 * @property string $description
 * @property int $duration
 *
 * @property User $author
 * @property Discipline $discipline
 * @property Question[] $questions
 * @property int $durationMillis
 */
class Test extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discipline_id', 'name', 'description'], 'required', 'message' => '{attribute} не должно быть пустым.'],
            [['discipline_id', 'author_id'], 'integer'],
            [['duration'], 'integer', 'min' => 3, 'message' => 'Тест должен длиться не менее {min}-х минут'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [
                ['author_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['author_id' => 'id']
            ],
            [
                ['discipline_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Discipline::class,
                'targetAttribute' => ['discipline_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'discipline_id' => 'Предмет',
            'name' => 'Тема',
            'description' => 'Описание',
            'duration' => 'Длительность',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::class, ['id' => 'discipline_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::class, ['test_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestQuery(get_called_class());
    }

    /**
     * @return int
     */
    public function getDurationMillis(): int
    {
        return $this->duration * 60 * 1000;
    }
}
