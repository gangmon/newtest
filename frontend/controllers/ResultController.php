<?php

namespace frontend\controllers;

use common\models\Choice;
use common\models\Judgement;
use common\models\Judgementpaper;
use Yii;
use frontend\models\Result;
use frontend\models\ResultSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Choicepaper;

use yii\widgets\DetailView;
/**
 * ResultController implements the CRUD actions for Result model.
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\base\Model;
class ResultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Result models.
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $searchModel = new ResultSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }
//开始考试
    public function actionJudgement()
    {
        $result = new Result();

        $queryID = Yii::$app->db->createCommand('SELECT id from test_judgement')->queryAll();
        shuffle($queryID);
        $how_mangJudgement = 3;
        $shuffleIDs = array_slice($queryID, 0, $how_mangJudgement);
        $judgementforms = [new Judgementpaper()];
        for ($i = 0; $i < $how_mangJudgement - 1; $i++) {
            $judgementforms[] = new Judgementpaper();
            $judgementforms[$i]->judgement_id = $shuffleIDs[$i]['id'];
        }
//        print_r($queryID);die;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $result->score = 0;
            $result->user_id = Yii::$app->user->id;
            print_r($result);echo "<br>";
            print_r($shuffleIDs[2]['id']);echo "<br>";
            echo "<pre>"; print_r($result); echo "</pre>";

            $result->save();
            print_r("Save ok");
            if (Model::loadMultiple($judgementforms, Yii::$app->request->post()) && Model::validateMultiple($judgementforms)) {
                print_r("losdfiodshdfdkslafjkl");
                $i = 0;
                foreach ($judgementforms as $judgementform) {
                    $judgementform->result_id = $result->id;
                    $judgementform->judgement_id = $shuffleIDs[$i]['id'];
//                    echo "<pre>"; print_r($judgementform); echo "</pre>";
                    $judgementform->save();
                    $i++;
                }
                $transaction->commit();
            }else{
                return $this->render('_allJudgementform',[
                    'judgementforms' => $judgementforms,
                    'shuffleids' => $shuffleIDs,
                ]);
            }
        } catch (Exception $e){
                $transaction->rollBack();
        }
//        echo "<pre>"; print_r($judgementforms); echo "</pre>";
        return $this->render('_allJudgementform',[
            'judgementforms' => $judgementforms,
            'shuffleids' => $shuffleIDs,

        ]);
    }

    public function actionChoice()
    {
        $result =  new Result();
        $searchModel = new ResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        //////////////////////////////////////////////
        ///
        ///
        $queryID = Yii::$app->db->createCommand('SELECT id FROM test_choice')->queryAll();
        //打乱顺序
        shuffle($queryID);
        $how_mangChoice = 5;
        $shuffleIDs = array_slice($queryID,0,$how_mangChoice);

        $choiceforms = [new Choicepaper()];
        $count = count(Yii::$app->request->post('Choicepaper', []));
        for ($i = 0;$i < $how_mangChoice-1;$i++){
            $choiceforms[] = new Choicepaper();
            $choiceforms[$i]->choice_id = $shuffleIDs[$i]['id'];
            $choiceforms[$i]->result_id = $result->id;
        }

        $transaction = Yii::$app->db->beginTransaction();
try {
    $result->score = 0;
    print_r(Yii::$app->user->id);
    $result->user_id = Yii::$app->user->id;
    print_r($result->user_id);
//            echo "<pre>"; print_r($result->id); echo "</pre>";
//    echo "<pre>"; print_r($result); echo "</pre>";
//        echo "<br><br><br><br>";
    echo "<pre>";
    print_r($result->user_id);
    echo "</pre>";
//        echo "<br><br><br><br>";
    $result->save();

        if (Model::loadMultiple($choiceforms, Yii::$app->request->post()) && Model::validateMultiple($choiceforms)) {

            print_r("losdfiodshdfdkslafjkl");
            $i = 0;
            foreach ($choiceforms as $choiceform) {
                $choiceform->result_id = $result->id;
                $choiceform->choice_id = $shuffleIDs[$i]['id'];
                $choiceform->save();
                $i++;
            }
            $transaction->commit();
        } else {
            return $this->render('_allChoiceform', [
                'choiceform' => $choiceforms,
                'result' => $result,
            ]);
        }


    }catch
    (Exception $e){
        $transaction->rollBack();
    }


        return $this->render('_allChoiceform', [
            'choiceform' => $choiceforms,
//            'modeltitle' => $choicequiz,
            'result' => $result,
        ]);


    }

    /**
     * Displays a single Result model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Result model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Result();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Result model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Result model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Result model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Result the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Result::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
