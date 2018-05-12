<?php

/* @var $this yii\web\View */
/* @var $disciplineNames string[] */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <table>
        <?php foreach ($disciplineNames as $id => $name): ?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $name ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
