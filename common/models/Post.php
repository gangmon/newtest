<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use backend\models\Adminuser;
/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property string $status
 * @property integer $author_id
 * @property integer $create_at
 * @property integer $update_at
 *
 * @property Comment[] $comments
 * @property Adminuser $author
 */

class Post extends \yii\db\ActiveRecord
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
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'tags', 'author_id'], 'required'],
            [['content', 'status'], 'string'],
            [['author_id', 'create_at', 'update_at'], 'integer'],
            [['title', 'tags'], 'string', 'max' => 128],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Adminuser::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '标题'),
            'content' => Yii::t('app', '内容'),
            'tags' => Yii::t('app', '标签'),
            'status' => Yii::t('app', '状态'),
            'author_id' => Yii::t('app', '作者'),
            'create_at' => Yii::t('app', '创建时间'),
            'update_at' => Yii::t('app', '更新时间'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Adminuser::className(), ['id' => 'author_id']);
    }

    /**
     * @inheritdoc
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }
}
