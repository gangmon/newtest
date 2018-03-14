<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Judgement;
use yii\widgets\ActiveForm;
$this->title = "判断题详情";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        foreach ($shuffleids as $shuffled){
            $model = Judgement::findOne($shuffled['id']);
//            echo $this->render('_judgementtitle',[
//                'model' => $model,
//            ]);
        }
    ?>

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $i = 0;
        foreach ($judgementforms as $judgementform => $v){
          $model = Judgement::findOne($shuffleids[$i]['id']);
            echo $this->render('_judgementtitle',[
                    'model' => $model,
            ]);
            echo $form->field($v, "[{$judgementform}]judgement_answer")->dropDownList([ 1 => '对', 2 => '错', ], ['prompt' => '请选择答案']);
        $i ++;
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '提交'),['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>