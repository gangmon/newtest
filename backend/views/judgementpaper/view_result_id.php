<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<div class="judgementpaper-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'judgement_answer',
            [
                'attribute' => 'judgement_answer',
                'label' => '考生答案',
                'value' => $model->judgement_answer?$model->judgement_answer:"未作答",
            ],
        ],
    ]) ?>

</div>
