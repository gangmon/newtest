<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $status
 * @property integer $create_at
 * @property integer $user_id
 * @property string $email
 * @property string $url
 * @property integer $post_id
 * @property integer $remind
 *
 * @property Post $post
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'create_at', 'user_id', 'post_id', 'remind'], 'required'],
            [['title', 'status'], 'string'],
            [['create_at', 'user_id', 'post_id', 'remind'], 'integer'],
            [['email'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 256],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
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
            'title' => Yii::t('app', '评论内容'),
            'status' => Yii::t('app', '状态'),
            'create_at' => Yii::t('app', '评论时间'),
            'user_id' => Yii::t('app', '评论者'),
            'email' => Yii::t('app', '邮箱'),
            'url' => Yii::t('app', 'Url'),
            'post_id' => Yii::t('app', '文章'),
            'remind' => Yii::t('app', 'Remind'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }
}
