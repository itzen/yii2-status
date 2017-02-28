<?php
/**
 * @var yii\web\View $this
 * @var sonkei\status\models\Status $model
 */
use sonkei\status\Module as StatusModule;

$this->title = StatusModule::t('core', 'Update status');
$this->params['breadcrumbs'][] = ['label' => StatusModule::t('core', 'All statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="status-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
