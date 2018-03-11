<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title:ntext',
//            'answer',
            [
                'attribute' => 'answer',
//                'value'=>function ($model){return $model->answer==1?'对':'错';}
            ],

        ],

    ]) ?>


