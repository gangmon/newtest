<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Judgement;
$this->title = "判断题详情";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        foreach ($shuffleids as $shuffled){
            $model = Judgement::findOne($shuffled);
            echo $this->render('_judgementtitle',[
                'model' => '$model',
            ]);
        }
    ?>

</div>