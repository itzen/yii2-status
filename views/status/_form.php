<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var common\models\core\Status $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="status-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); 
    echo $form->errorSummary($model); 
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
            'sortorder'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>Yii::t('common', 'Enter Sortorder...')]],
'name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>Yii::t('common', 'Enter Name...'), 'maxlength'=>45]],
'object_key'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>Yii::t('common', 'Enter Object Key...'), 'maxlength'=>128]],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>


</div>
