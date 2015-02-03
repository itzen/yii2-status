<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\core\Status $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-view">
    
    <?= 
    DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'mode' => (Yii::$app->request->get('edit') == 't' || $model->hasErrors()) ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
        'i18n' => Yii::$app->i18n->translations['*'],
        'panel' => [
            'heading' => $this->title,
            'type' => DetailView::TYPE_INFO,
        ],
        'attributes' => [
            [
                'attribute' => 'id',
                'options' => [
                    'readonly' => 'readonly'
                ]
            ],
            'sortorder',
            'name',
            'object_key',
        ],
        'deleteOptions' => [
            'url' => ['delete', 'id' => $model->id],
            'data' => [
                'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ],
        'enableEditMode' => true,
    ]); 
    ?>

</div>
