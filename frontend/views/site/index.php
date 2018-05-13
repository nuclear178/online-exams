<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';

$this->registerCss(/** @lang CSS */
    "
.site-index li {
    font-size: 22px;
}
");

?>
<div class="site-index">
    <h1>Система тестирования знаний студентов</h1>
    <ul>
        <li>
            <div>
                <a href="<?= Url::to(['discipline/index']) ?>"><h3>Предметы</h3></a>
                <p></p>
            </div>
        </li>
        <li>
            <div>
                <a href="<?= Url::to(['test/index']) ?>"><h3>Тесты</h3></a>
                <p></p>
            </div>
        </li>
    </ul>
</div>
