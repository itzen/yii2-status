<?php
/**
 * @var yii\web\View $this
 * @var \sonkei\status\models\Status $model
 */

use sonkei\status\Module as StatusModule;
use yii\bootstrap\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => StatusModule::t('core', 'All statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-view">
    <p>
        <?= Html::a(StatusModule::t('core', 'Update status'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']); ?>
        <?= Html::a(StatusModule::t('core', 'Delete status'), ['delete', 'id' => $model->id], ['class' => 'btn btn-warning']); ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'priority',
            'name',
            'object_key',
        ]
    ]); ?>

</div>
