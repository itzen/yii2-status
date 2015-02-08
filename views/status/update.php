<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\core\Status $model
 */

$this->title = Yii::t(\itzen\status\Module::$translateCategory, 'Update {modelClass}: ', [
    'modelClass' => 'Status',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t(\itzen\status\Module::$translateCategory, 'Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t(\itzen\status\Module::$translateCategory, 'Update');
?>
<div class="status-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
