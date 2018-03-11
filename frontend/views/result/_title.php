<?php
//显示题目内容，不包含答案
use common\models\Judgementpaper;
use common\models\Judgement;
use common\models\Choicepaper;
use common\models\Choice;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<!--先显示选择题，然后选择填空题-->
<!--<h1>判断题</h1>-->
<?php
//$judgementquiz = Judgement::find()->indexBy('id')->all();
//$judgementform = new Judgementpaper();
//    foreach ($judgementquiz as $judgement){
//        echo $this->render('_judgementtitle',[
//            'model'  => $judgement,
//        ]);
//
//        echo $this->render('_judgementform', [
//            'model' => $judgementform,
//        ]);
//}
//?>

<!--//这里显示选择题-->
<!--<h1>选择题</h1>-->
<?php
//$choicequiz = Choice::find()->all();
//$choiceform = new Choicepaper();
//    foreach ($choicequiz as $choice) {
//        echo $this->render('_choicetitle', [
//            'model' => $choice,
//        ]);
//
//        echo $this->render('_choiceform', [
//            'model' => $choiceform,
//        ]);
//
//    }
//?>
<?php
//if ($judgementform->load(Yii::$app->post()) && $choiceform->load(Yii::$app->post())){
//    $transaction = Yii::$app->db->beginTransaction();
//    try{
//        $result->score = 0;
//        $result->user_id = Yii::$app->user->id;
//        $result->cerate_time = time();
////        $result->status = '无效';
//        $result->save();
//
//    } catch(Exception $e){
//
//    }
//
//
//$queryID = Yii::$app->db->createCommand('SELECT id FROM test_choice')->queryAll();
////$numID = range($queryID);
////打乱顺序
//shuffle($queryID);
//$how_mangChoice = 5;
//$shuffleIDs = array_slice($queryID,0,$how_mangChoice);
//foreach ($shuffleIDs as $shuffleID ){
//    $choicequiz = Choice::findOne($shuffleID);
//    echo $this->render('_choicetitle', [
//        'model' => $choicequiz,
//    ]);
//
//}

//        echo "<pre>"; print_r($result->id); echo "</pre>";
//        echo "<pre>"; print_r($result); echo "</pre>";
//        echo "<br><br><br><br>";
//        echo "<pre>"; print_r($result->user_id); echo "</pre>";
//        echo "<br><br><br><br>";
//        echo "<pre>"; print_r($result->user); echo "</pre>";
?>

<?php $form = ActiveForm::begin();
$transaction = Yii::$app->db->beginTransaction();
try{
    print_r('hahahahhahahahahhhh');
    $result->score = 0;
//    print_r('pppppppphahahahhahahahahhhh');
//    print_r('<br>');
    print_r( Yii::$app->user->id);
    $result->user_id = Yii::$app->user->id;
//    print_r('<br>');
    print_r($result->user_id);
//    $result->cerate_time = time();

//    print_r('gggggggggggggggggg');
//        $result->status =
//            echo "<pre>"; print_r($result->id); echo "</pre>";
//    echo "<pre>"; print_r($result); echo "</pre>";
//        echo "<br><br><br><br>";
        echo "<pre>"; print_r($result->user_id); echo "</pre>";
//        echo "<br><br><br><br>";
//        echo "<pre>"; print_r($result->user); echo "</pre>";

    $result->save();

    //得到choice表中的所有id
    $queryID = Yii::$app->db->createCommand('SELECT id FROM test_choice')->queryAll();
    //$numID = range($queryID);
    //打乱顺序
    shuffle($queryID);
    $how_mangChoice = 5;
    $shuffleIDs = array_slice($queryID,0,$how_mangChoice);

    $choiceforms = [new Choicepaper()];
    $count = count(Yii::$app->request->post('Choicepaper', []));
    for ($i = 0;$i < $how_mangChoice-1;$i++){
        $choiceforms[] = new Choicepaper();
        $choiceforms[$i]->choice_id = $shuffleIDs[$i]['id'];
    }
//    print_r($choiceforms[1]);
    echo "<pre>"; var_dump($choiceforms[0]->result_id); echo "</pre>";
    echo "<br><br><br><br>";
    echo "<pre>"; print_r($shuffleIDs[0]['id']); echo "</pre>";
    echo "<br><br><br><br>";
    echo "<pre>"; print_r($choiceforms); echo "</pre>";


    echo "<br><br><br><br>";
//
    echo "<br><br><br><br>";
//    echo "<pre>"; print_r($result->id); echo "</pre>";
    echo "<br><br><br><br>";
    echo "<pre>"; print_r($shuffleIDs); echo "</pre>";





    foreach ($shuffleIDs as $shuffleID ){
        $choicequiz = Choice::findOne($shuffleID);
        echo $this->render('_choicetitle', [
            'model' => $choicequiz,
        ]);
        //新建一个选择题下拉菜单，用来存放考试结果
//        $choiceforms[] = new Choicepaper();


        echo $this->render('_choiceform', [
            'model' => $choiceforms[1],
            'result' => $result,
        ]);

    }
//    if ($choiceform->load(Yii::$app->request->post()) && $choiceform->save()) {
//        return $this->redirect(['view', 'id' => $choiceform->id]);
//    } else {
//        return $this->render('_title', [
//            'model' => $model,
//        ]);
//    }
//    $transaction->commit();

} catch(Exception $e){
    $transaction->rollBack();
}



?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '提交'),['class' => 'btn btn-success']); ?>
    </div>
<?php
ActiveForm::end();
?>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
