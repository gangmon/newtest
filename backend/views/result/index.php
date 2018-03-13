<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::t('app', 'Results');
$this->title = '考试结果总览';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="result-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\ActionColumn'],
//            ['class' => 'yii\grid\CheckboxColumn'],
            [
                    'attribute' => 'id',
                    'label' => '考试编号',
//                    'contentOptions' => ['width' => '40px'],
            ],
//            'user_id',
            [
                    'attribute' => 'user_id',
                    'label' => '考试者编号ID',
//                'contentOptions' => ['width' => '30px'],
            ],
            [
                    'attribute' => 'quizName',
                    'label' => '考试人姓名',
                    'value' => 'user.username',
//                    'filter' => ['user_id' => 'user.username'],
//                    'filter' => \backend\models\Adminuser::find()
//                    ->select(['username'])
//                    ->indexBy('username')
//                    ->column(),

            ],
            'score',
//            'create_time:datetime',
            [
                    'attribute' => 'create_time',
                    'label'=>'考试时间',
                    'format' => ['date', 'php:Y-m-d'],
                    'value' => 'create_time',
            ],
            [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'template' => '{view}',//只需要展示删除和更新
                    'headerOptions' => ['width' => '100'],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span', '查看',
                            ['class' => "glyphicon fa fa-eye"]),
                            ['result/view', 'id'=>$model->id],
                            ['class' => "btn btn-xs btn-success", 'title' => '查看']);
                    },
//                    'update' => function ($url, $model, $key)  {
//                        return Html::a('通过', ['admin/reviewapp','id'=>$model->id, 'status'=>1], ['class' => "btn btn-xs btn-info"]);
//                    },
//                    'delete' => function ($url, $model, $key) {
//                            return Html::a('拒绝', ['admin/reviewapp', 'id' => $model->id, 'status'=>0], ['class' => "btn btn-xs btn-danger"]);
//                    }
                ]

            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
