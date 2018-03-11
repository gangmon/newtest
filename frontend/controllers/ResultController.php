<?php

namespace frontend\controllers;

use common\models\Choice;
use common\models\Judgement;
use Yii;
use frontend\models\Result;
use frontend\models\ResultSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Choicepaper;


/**
 * ResultController implements the CRUD actions for Result model.
 */
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
    public function actionIndex()
    {
        $result =  new Result();
        $searchModel = new ResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        $transaction = Yii::$app->db->beginTransaction();
//        try{
//            print_r('hahahahhahahahahhhh');
//            $result->score = 0;
////    print_r('pppppppphahahahhahahahahhhh');
////    print_r('<br>');
//            print_r( Yii::$app->user->id);
//            $result->user_id = Yii::$app->user->id;
////    print_r('<br>');
//            print_r($result->user_id);
//
//            $result->save();
//
//            //得到choice表中的所有id
//            $queryID = Yii::$app->db->createCommand('SELECT id FROM test_choice')->queryAll();
//            //$numID = range($queryID);
//            //打乱顺序
//            shuffle($queryID);
//            $how_mangChoice = 5;
//            $shuffleIDs = array_slice($queryID,0,$how_mangChoice);
//            foreach ($shuffleIDs as $shuffleID ){
//                $choicequiz = Choice::findOne($shuffleID);
//                echo $this->render('_choicetitle', [
//                    'model' => $choicequiz,
//                ]);
//                //新建一个选择题下拉菜单，用来存放考试结果
//                $choiceform = new Choicepaper();
//                echo $this->render('_choiceform', [
//                    'model' => $choiceform,
//                    'result' => $result,
//                ]);
//            }
//            $transaction->commit();
//
//        } catch(\Exception $e){
//            $transaction->rollBack();
//
//        }
        echo $this->render('_title', [

//            'model' => $choicequiz,
            'result' => $result,
        ]);



//        foreach ($judgementquiz as $judgement){
//            echo $this->render('_judgementtitle',[
//                'model'  => $judgement,
//            ]);
//        }



//        return $this->render('quiz', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//            'choicequiz' => $choicequiz,
//            'judgementquiz' => $judegementquiz,
//        ]);
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
