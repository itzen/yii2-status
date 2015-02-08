<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\core\Status $model
 */

$this->title = Yii::t(\itzen\status\Module::$translateCategory, 'Create {modelClass}', [
    'modelClass' => 'Status',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t(\itzen\status\Module::$translateCategory, 'Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
