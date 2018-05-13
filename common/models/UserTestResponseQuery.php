<?php

namespace common\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[UserTestResponse]].
 *
 * @see UserTestResponse
 */
class UserTestResponseQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserTestResponse[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserTestResponse|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
