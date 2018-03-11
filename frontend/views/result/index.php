<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Results');
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="leftnav" class="col-md-3" style="float: right">
    <div class="list-group">
        <!-- 用户管理 -->
        <a class="list-group-item" data-toggle="collapse" href="#usercollapse" aria-expanded="false" aria-controls="collapseExample" style="float: right">用户管理<span class="caret"></span></a>
        <div class="collapse" id="usercollapse">
            <div class="well">
                <div class="list-group">
                    <a href="<?= Url::toRoute(['user/index'])?>" class="list-group-item">用户列表（gii）</a>
                    <a href="<?= Url::toRoute(['user/manualuser'])?>" class="list-group-item">用户列表（manual）</a>
                </div>
            </div>
        </div>
        <!-- 权限管理 -->
        <a class="list-group-item" data-toggle="collapse" href="#resourcecollapse" aria-expanded="false" aria-controls="collapseExample" style="float: right">资源管理<span class="caret"></span></a>
        <div class="collapse" id="resourcecollapse">
            <div class="well">
                <div class="list-group">
                    <a href="<?= Url::toRoute(['user/index'])?>" class="list-group-item">用户列表（gii）</a>
                    <a href="<?= Url::toRoute(['user/index'])?>" class="list-group-item">用户列表（gii）</a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="result-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Result'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'score',
            'create_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
