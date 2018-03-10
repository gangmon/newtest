<?php

namespace frontend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "{{%result}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $score
 * @property integer $create_time
 *
 * @property Choicepaper[] $choicepapers
 * @property Judgementpaper[] $judgementpapers
 * @property User $user
 */
class Result extends \yii\db\ActiveRecord
{

    public $quizname;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%result}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'score'], 'required'],
            [['user_id', 'score', 'create_time'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', '参与考试人员id'),
            'score' => Yii::t('app', '考试分数'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChoicepapers()
    {
        return $this->hasMany(Choicepaper::className(), ['result_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgementpapers()
    {
        return $this->hasMany(Judgementpaper::className(), ['result_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    //得到考试人姓名
    public function getQuizname(){
        $quizname = $this->user->username;
        return $this->user->username;
//        return $this->hasOne(User::className(),['username' => $this->user->id]);
    }


    /**
     * @inheritdoc
     * @return ResultQuery the active query used by this AR class.
     */

    public static function find()
    {
        return new ResultQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->create_time = time();
            }
            else
            {

            }
            return true;

        }
        else
        {
            return false;
        }
    }
}
