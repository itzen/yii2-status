<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\core\models\search\Status $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="status-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sortorder') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'object_key') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t(Yii::$app->getModule('status')->translateCategory, 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t(Yii::$app->getModule('status')->translateCategory, 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
