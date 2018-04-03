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
 * @property integer $times
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
            [['title', 'content', 'tags'], 'required'],
            [['content', 'status'], 'string'],
            [['author_id', 'created_at', 'updated_at','times'], 'integer'],
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
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
            'times' => Yii::t('app', '阅读次数'),
        ];
    }
    /**
     * 获取标签云
     */
//    public function getTagLinks()
//    {
//        $links = array();
//        foreach ()
//    }

    /**
     * 获取URL地址
     *
     */
    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl([
            'post/detail',
            'id' => $this->id,
            'title' => $this->title
        ]);
    }
    /**
     *获取激活（通过审核的）的评论
     *
     */
    public function getActiveComments()
    {
        return $this->hasMany(Comment::className(),['post_id' => 'id'])
            ->where('status=:status',[':status' => "已审核"])->orderBy('id DESC');
    }
    /**
     * 获取评论数量
     */
    public function getCommentCount()
    {
        return Comment::find()->where(['post_id' => $this->id,'status' => '已审核'])->count();
    }

    /**
     * 获取评论
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
    //设置在总览页面题目的长度
//    public function getBeginning()
//    {
//        $tmpStr = strip_tags($this->content);
//        $tmpLen = mb_strlen($tmpStr);
//
//        return mb_substr($tmpStr,0,18,'utf-8').(($tmpLen>18)?'...':'');
//    }
    public function getBeginning($length=18)
    {
        $tmpStr = strip_tags($this->content);
        $tmpLen = mb_strlen($tmpStr);

        $tmpStr = mb_substr($tmpStr,0,$length,'utf-8');
        return $tmpStr.($tmpLen>$length?'...':'');
    }
    public function getBeginning188($length=150)
    {
        $tmpStr = strip_tags($this->content);
        $tmpLen = mb_strlen($tmpStr);

        $tmpStr = mb_substr($tmpStr,0,$length,'utf-8');
        return $tmpStr.($tmpLen>$length?'...':'');
    }

    public static function findTagsWeight($limit = 20)
    {
        $tag_size_level = 5;
        $models = Post::find()->orderBy('times desc')->limit($limit)->all();
        $total = Post::find()->limit($limit)->count();
        //算出每个档次应该放几个标签
        $stepper = ceil($total/$tag_size_level);

        $tags = array();
        $counter = 1;
        if ($total > 0)
        {
            foreach ($models as $model)//给tags数组赋值
            {
                $weight = ceil($counter/$stepper) + 1;
                $tags[$model->tags] = $weight;
                $counter++;
            }
            ksort($tags);
        }
        return $tags;
    }

    //设置出题人
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->author_id = Yii::$app->user->id;
            }
            return true;

        }
        else
        {
            return false;
        }
    }

    public static function findRecentComment($limit = 5)
    {
        return Comment::find()->where(['status' => '已审核'])->orderBy('created_at DESC')->limit($limit)->all();
    }
}
