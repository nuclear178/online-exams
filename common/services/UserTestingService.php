<?php

namespace common\services;

use common\models\UserTest;
use common\models\UserTestResponse;
use InvalidArgumentException;

class UserTestingService
{
    /**
     * @var int $userId
     */
    protected $userId;

    /**
     * UserTestingService constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param int $testId
     */
    public function beginTest(int $testId)
    {
        if ($this->isNowPassingTest()) {
            throw new InvalidArgumentException("User test for user id '$this->userId' is not found!");
        }

        $userTest = new UserTest();
        $userTest->user_id = $this->userId;
        $userTest->test_id = $testId;
        $userTest->save();
    }

    /**
     * Returns if the specified user is now passing any test
     *
     * @return bool
     */
    public function isNowPassingTest(): bool
    {
        $userTests = UserTest::find()->where(['user_id' => $this->userId])->all();
        foreach ($userTests as $userTest) {
            if (!$userTest->isCompleted()) {
                return true;
            }
        }

        return false;
    }

    public function getNowPassingTest(): UserTest
    {
        $userTests = UserTest::find()->where(['user_id' => $this->userId])->all();
        foreach ($userTests as $userTest) {
            if (!$userTest->isCompleted()) {
                return $userTest;
            }
        }

        throw new InvalidArgumentException("User test for user id '$this->userId' is not found!");
    }

    public function completeCurrentTest()
    {
        if (!$this->isNowPassingTest()) {
            throw new InvalidArgumentException("User test for user id '$this->userId' is not found!");
        }

        $currentTest = $this->getNowPassingTest();
        $currentTest->completed = 1;
        $currentTest->save();
    }

    public function hasUnansweredQuestions(): bool
    {
        if (!$this->isNowPassingTest()) {
            throw new InvalidArgumentException("User test for user id '$this->userId' is not found!");
        }

        $currentTest = $this->getNowPassingTest();

        return UserTestResponse::find()
            ->where(['user_test_id' => $currentTest->id])
            ->andWhere(['answer' => null])
            ->exists();
    }

    public function prepareNextQuestion(): UserTestResponse
    {
        if (!$this->hasUnansweredQuestions()) {
            throw new InvalidArgumentException("There are no unanswered questions left!");
        }

        $currentTest = $this->getNowPassingTest();

        return UserTestResponse::find()
            ->where(['user_test_id' => $currentTest->id])
            ->andWhere(['answer' => null])
            ->one();
    }

    public function anotherTestIsPassed(int $testId): bool
    {
        return $this->getNowPassingTest()->test->id !== $testId;
    }
}
