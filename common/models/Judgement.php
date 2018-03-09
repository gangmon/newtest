<?php

namespace common\models;
use backend\models\Adminuser;
use Yii;

/**
 * This is the model class for table "{{%judgement}}".
 *
 * @property integer $id
 * @property integer $admin_id
 * @property string $title
 * @property string $answer
 * @property integer $score
 * @property integer $create_time
 * @property integer $update_time
 *
 * @property Adminuser $admin
 * @property Judgementpaper[] $judgementpapers
 */
class Judgement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%judgement}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'title', 'answer', 'create_time', 'update_time'], 'required'],
            [['admin_id', 'score', 'create_time', 'update_time'], 'integer'],
            [['title', 'answer'], 'string'],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Adminuser::className(), 'targetAttribute' => ['admin_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'admin_id' => Yii::t('app', '出题人'),
            'title' => Yii::t('app', '出题人'),
            'answer' => Yii::t('app', '答案'),
            'score' => Yii::t('app', '分数，默认5分'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Adminuser::className(), ['id' => 'admin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgementpapers()
    {
        return $this->hasMany(Judgementpaper::className(), ['judgement_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return JudgementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JudgementQuery(get_called_class());
    }
}
