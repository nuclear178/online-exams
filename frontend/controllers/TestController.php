<?php

namespace frontend\controllers;

use common\models\Discipline;
use common\models\Question;
use common\models\Test;
use common\models\UserTestResponse;
use common\services\UserTestingService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
{
    /**
     * @var UserTestingService $service
     */
    protected $service;

    public function init()
    {
        $this->service = new UserTestingService(Yii::$app->getUser()->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Test::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Test model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $disciplineId
     * @return mixed
     */
    public function actionCreate(int $disciplineId = null)
    {
        $model = new Test();

        if ($model->load(Yii::$app->request->post())) {
            $model->author_id = Yii::$app->getUser()->getId();
            if ($model->save()) {
                return $this->redirect(['question/create', 'testId' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'disciplineNames' => ($disciplineId === null) ? Discipline::getNames()
                : [$disciplineId => Discipline::findOne($disciplineId)->name],
        ]);
    }

    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'disciplineNames' => Discipline::getNames()
        ]);
    }

    /**
     * Deletes an existing Test model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $testId
     * @return string|\yii\web\Response
     */
    public function actionPass($testId)
    {
        if ($this->service->isNowPassingTest()) {

            //user is now passing another test
            if ($this->service->anotherTestIsPassingNow($testId)) {
                return $this->render('already_passing_message', [
                    'newTestId' => $testId,
                    'oldTest' => $this->service->getNowPassingTest()->test
                ]);
            }

            //continue passing current test
            if ($this->service->hasUnansweredQuestions()) {
                $nextQuestion = $this->service->prepareNextQuestion();

                return $this->redirect(['test/question', 'responseId' => $nextQuestion->id]);
            }

            //show results if there are no questions left
            $this->service->completeCurrentTest();
            return $this->redirect(['test/result', 'testId' => $testId]);
        }

        if ($this->service->alreadyPassedTest($testId)) {
            return $this->redirect(['test/result', 'testId' => $testId]);
        }

        $this->service->beginTest($testId);
        return $this->redirect(['test/pass', 'testId' => $testId]);
    }

    /**
     * @param int $nextTestId
     * @return \yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionComplete(int $nextTestId = null)
    {
        if (!$this->service->isNowPassingTest()) {
            throw new ForbiddenHttpException('No test is passed at this moment!');
        }

        $this->service->completeCurrentTest();

        if ($nextTestId !== null) {
            return $this->redirect(['test/pass', 'testId' => $nextTestId]);
        }

        return $this->goHome();
    }

    /**
     * @param int $responseId
     * @return string|\yii\web\Response
     */
    public function actionQuestion(int $responseId)
    {
        $response = UserTestResponse::findOne($responseId);

        if ($response->load(Yii::$app->request->post()) && $response->save()) {
            return $this->redirect(['test/pass', 'testId' => $response->testId]);
        }

        return $this->render('response_form', ['model' => UserTestResponse::findOne($responseId)]);
    }

    public function actionResult(int $testId)
    {
        $model = $this->findModel($testId);

        return $this->render('results', [
            'score' => $this->service->getScore($testId),
            'test' => $model,
            'max' => Question::find()->where(['test_id' => $testId])->count(),
        ]);
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
