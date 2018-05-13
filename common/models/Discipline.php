<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "discipline".
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property Test[] $tests
 * @property string $description
 */
class Discipline extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discipline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required', 'message' => '{attribute} не должно быть пустым.'],
            [['description'], 'string'],
            [['slug', 'name'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'description' => 'Описание',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DisciplineQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DisciplineQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasMany(Test::class, ['discipline_id' => 'id']);
    }

    /**
     * @return string[] an array of names associated with ids [$id => $name]
     */
    public static function getNames(): array
    {
        $query = (new Query())
            ->select(['id', 'name'])
            ->from([self::tableName()]);

        $names = [];
        foreach ($query->all(self::getDb()) as $row) {
            $names[$row['id']] = $row['name'];
        }

        return $names;
    }
}
