<?php

use yii\helpers\Html;
use common\models\Judgement;

/* @var $this yii\web\View */
/* @var $model common\models\Judgementpaper */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Judgementpapers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgementpaper-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], []) ?>
    </p>

    <?php
        foreach ($models as $model)
        {
            $aboutJudgement = Judgement::findOne($model->judgement_id);
            echo $this->render('/judgement/_judgemnet_view_only',['model' => $aboutJudgement]);
            echo $this->render('view_result_id',['model' => $model ]);
        }
    ?>


</div>
