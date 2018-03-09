<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\JudgementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Judgements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Judgement'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                    'attribute' => 'id',
                    'label' => '编号',
                    'contentOptions' => ['width' => '20px'],
            ],
            'title:ntext',
//            'answer',
            [
                    'attribute' => 'answer',
                    'contentOptions' => ['width' => '30px'],
                    'value' => function ($model){return $model->answer==1?'对':'错';},
                    'filter' => [1 => '对',2 => '错'],
            ],
//            'score',
            [
                    'attribute' => 'score',
                    'label' => '分数',
                    'contentOptions' => ['width' => '50px'],
            ],
//            'admin_id',
            [
                    'attribute' => 'admin_id',
                    'value' => 'admin.username',
                    'contentOptions' => ['width' => '40px'],
                    'filter' => \backend\models\Adminuser::find()
                    ->select(['username'])
                    ->indexBy('id')
                    ->column(),
            ],
            // 'create_time:datetime',
            // 'update_time:datetime',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'headerOptions' => ['width' => '100'],

            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
