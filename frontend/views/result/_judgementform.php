<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<!--<div class="judgementpaper-form">-->

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'result_id')->textInput() ?>
<?php  ?>
<!--    --><?//= $form->field($model, 'judgement_id')->textInput() ?>

    <?= $form->field($model, 'judgement_answer')->dropDownList([ 1 => '对', 2 => '错', ], ['prompt' => '请选择答案']) ?>

<!--    --><?//= $form->field($model, 'test_time')->textInput() ?>

<!--    <div class="form-group">-->
<!--        --><?//= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
<!--    </div>-->

    <?php ActiveForm::end(); ?>

<!--</div>-->