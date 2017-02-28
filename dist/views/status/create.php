<?php
/**
 * @var yii\web\View $this
 * @var sonkei\status\models\Status $model
 */
use sonkei\status\Module as StatusModule;

$this->title = StatusModule::t('core', 'Create status');

$this->params['breadcrumbs'][] = ['label' => StatusModule::t('core', 'All statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
