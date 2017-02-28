<?php
/**
 * @var yii\web\View $this
 * @var \sonkei\status\models\Status $model
 * @var yii\widgets\ActiveForm $form
 */

use sonkei\status\Module as StatusModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<div class="status-form">

    <?php
    $form = ActiveForm::begin([
        'layout' => 'horizontal'
    ]);

    echo $form->errorSummary($model);

    echo $form->field($model, 'name')->textInput(['max' => true]);

    echo $form->field($model, 'object_key')->textInput(['max' => true]);

    echo $form->field($model, 'priority')->textInput(['max' => true]);

    echo Html::submitButton(StatusModule::t('core', 'Continue'), ['class' => 'btn btn-success']);

    $form::end();
    ?>
</div>
