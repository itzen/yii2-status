<?php
/**
 * @var $this yii\web\View
 * @var $searchModel sonkei\status\models\search\Status
 * @var $dataProvider yii\data\ActiveDataProvider
 */
use sonkei\status\Module as StatusModule;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = StatusModule::t('core', 'All statuses');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="status-index">

    <p>
        <?= Html::a(StatusModule::t('core', 'Create status'), ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'object_key',
            'priority',
            ['class' => 'yii\grid\ActionColumn']
        ]
    ]);
    ?>

</div>
