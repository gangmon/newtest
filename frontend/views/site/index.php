<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = '工作人员在线考试系统';
?>

<!--<ol class="breadcrumb" style="font-size: 21px;">-->
<!--    <li>-->
<!--        <a href="--><?php //Yii::$app->homeUrl;?><!--" class="glyphicon glyphicon-home">首页</a>-->
<!--        <a href="#"  class="glyphicon glyphicon-align-justify">目录</a>-->
<!--        <a href="#" class="glyphicon glyphicon-list-alt" >历史</a>-->
<!--        <a href="#" class="glyphicon glyphicon-stats" >等级</a>-->
<!--        <a href="#" class="glyphicon glyphicon-log-out">退出</a>-->
<!--    </li>-->
<!--</ol>-->



<div class="site-index">

    <div class="jumbotron">
        <h1>工作人员在线考试系统</h1>

        <p class="lead">这里有最权威的测试系统，包含井巷、通风、排水、爆破</p>
<!--        <p><a class="btn btn-lg btn-success" href="--><?php //Yii::$app->runAction('result/index');?><!--">点击进入考试系统</a></p>-->
        <p><?= Html::a('点击进入模拟考试系统',['result/allquiz'],['class' => "btn btn-lg btn-success",'style' => 'margin-top:19px;border-radius: 30px','data' => ['method' => 'post', 'params' => ['is_real' => '1']]])?>
        <?= Html::a('点击进入正式考试系统',['result/allquiz'],['class' => "btn btn-lg btn-primary",'style' => 'margin-top:19px;border-radius: 30px','data' => ['method' => 'post', 'params' => ['is_real' => '2']]])?></p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>模拟测试</h2>
                <p>本考试系统由数据库随机出题，进行电脑及时阅卷，可以检测工程安全员的专业知识水平，进行实时考核。同时也可以进行在线模拟测试。</p>

                <!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
                <p><?= Html::a('判断题模拟测试&raquo;',['result/judgement',],['class' => "btn btn-default" ])?></p>
                <p><?= Html::a('选择题模拟测试&raquo;',['result/choice'],['class' => "btn btn-default" ])?></p>
                <p><?= Html::a('仿真模拟测试&raquo;',['result/allquiz'],['class' => "btn btn-default",'data' => ['method' => 'post', 'params' => ['is_real' => '2']]])?></p>

            </div>
            <div class="col-lg-4">
                <h2>最新咨询</h2>

                <p>L17日，环境保护部部长李干杰在十三届全国人大一次会议记者会上表示，
                    环保部正在研究“蓝天保卫战三年作战计划”，估计很快出台。
                    三年蓝天保卫战的目标将在“十三五”规划目标基础上进一步深化，
                    有些目标可能会有适当提高。</p>

            </div>
            <div class="col-lg-4">
                <h2>探究讨论</h2>

                <p>矿产资源开采回采率、选矿回收率和综合利用率是衡量矿山企业开采技术优劣和企业管理水平、
                    资源利用程度高低的主要技术经济指标，
                    “三率”水平的高低决定矿山的当前经济效益与总的资源效益。</p>

            </div>
        </div>

    </div>
</div>