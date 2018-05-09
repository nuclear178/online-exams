<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 07.05.2018
 * Time: 13:36
 */

namespace console\controllers;

use yii\console\Controller;
use yii\rbac\DbManager;

class RbacController extends Controller
{
    /**
     * @var DbManager $auth
     */
    protected $auth;

    public function init()
    {
        $this->auth = \Yii::$app->authManager;
    }

    public function actionInit()
    {
        $this->auth->removeAll();

        //Roles
        $teacher = $this->auth->createRole('teacher');
        $teacher->description = 'Преподаватель';
        $this->auth->add($teacher);

        $student = $this->auth->createRole('student');
        $student->description = 'Студент';
        $this->auth->add($student);

        $admin = $this->auth->createRole('admin');
        $admin->description = 'Администратор';
        $this->auth->add($admin);
        $this->auth->addChild($admin, $teacher);
        $this->auth->addChild($admin, $student);

        //Categories
        $createCategory = $this->auth->createPermission('createCategory');
        $createCategory->description = 'Создание категорий';
        $this->auth->add($createCategory);
        $this->auth->addChild($teacher, $createCategory);

        $viewCategory = $this->auth->createPermission('viewCategory');
        $viewCategory->description = 'Просмотр категорий';
        $this->auth->add($viewCategory);
        $this->auth->addChild($teacher, $viewCategory);

        $updateCategory = $this->auth->createPermission('updateCategory');
        $updateCategory->description = 'Редактирование категорий';
        $this->auth->add($updateCategory);
        $this->auth->addChild($teacher, $updateCategory);

        $deleteCategory = $this->auth->createPermission('deleteCategory');
        $deleteCategory->description = 'Удаление категорий';
        $this->auth->add($deleteCategory);
        $this->auth->addChild($teacher, $deleteCategory);

        //Tests
        $createExam = $this->auth->createPermission('createExam');
        $createExam->description = 'Создание тестов';
        $this->auth->add($createExam);
        $this->auth->addChild($teacher, $createExam);

        $viewExam = $this->auth->createPermission('viewExam');
        $viewExam->description = 'Просмотр тестов';
        $this->auth->add($viewExam);
        $this->auth->addChild($teacher, $viewExam);

        $updateExam = $this->auth->createPermission('updateExam');
        $updateExam->description = 'Редактирование тестов';
        $this->auth->add($updateExam);
        $this->auth->addChild($teacher, $updateExam);

        $deleteExam = $this->auth->createPermission('deleteExam');
        $deleteExam->description = 'Удаление тестов';
        $this->auth->add($deleteExam);
        $this->auth->addChild($teacher, $deleteExam);

        //Assign
        $this->auth->assign($admin, 1);
    }

    public function actionRevoke()
    {
        $this->auth->removeAll();
    }
}
