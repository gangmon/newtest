<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Choice;

?>

<div class="choicepaper-view">

    <?php
        foreach ($models as $model){
            $aboutChoice = Choice::findOne($model->choice_id);
            echo $this->render('/choice/_choice_view_only',['model' => $aboutChoice]);
            echo $this->render('view_result_id',['model' => $model]);
        }
    ?>

<!--    --><?//= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'result_id',
//            'choice_id',
//            'choice_answer',
//            'test_time:datetime',
//        ],
//    ]) ?>

</div>
