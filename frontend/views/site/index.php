<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = '工作人员在线考试系统';
?>

<!--<ol class="breadcrumb" style="font-size: 21px;">-->
<!--    <li>-->
<!--        <a href="--><?//= Yii::$app->homeUrl;?><!--" class="glyphicon glyphicon-home">首页</a>-->
<!--        <a href="#"  class="glyphicon glyphicon-align-justify">目录</a>-->
<!--        <a href="#" class="glyphicon glyphicon-list-alt" >历史</a>-->
<!--        <a href="#" class="glyphicon glyphicon-stats" >等级</a>-->
<!--        <a href="#" class="glyphicon glyphicon-log-out">退出</a>-->
<!--    </li>-->
<!--</ol>-->



<div class="site-index">

    <div class="jumbotron">
        <h1>工作人员在线考试系统</h1>

        <p class="lead">这里有最权威的测试系统，包含通风、排水</p>

        <p><a class="btn btn-lg btn-success" href="<?php Yii::$app->runAction('result/index');?>">点击进入考试系统</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>初级</h2>

                <!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
                <p>
                    <?= Html::a('查看试卷&raquo;',['result/index'],['class' => "btn btn-default" ])?>
                </p>
            </div>
            <div class="col-lg-4">
                <h2>中级</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><?= Html::a('查看试卷&raquo;',['options/index'],['class' => "btn btn-default" ])?></p>
            </div>
            <div class="col-lg-4">
                <h2>高级</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><?= Html::a('查看试卷&raquo;',['quizresult/index'],['class' => "btn btn-default" ])?></p>
            </div>
        </div>

    </div>
</div>