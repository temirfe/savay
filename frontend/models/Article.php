<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $image
 * @property integer $category_id
 * @property integer $expert_id
 * @property string $date_create
 * @property string $footnotes
 */
class Article extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules=[
            [['title'], 'required'],
            [['text'], 'string'],
            [['category_id', 'expert_id', 'expert2_id', 'expert3_id'], 'integer'],
            [['date_create'], 'safe'],
            [['title'], 'string', 'max' => 500],
            [['image'], 'string', 'max' => 200],
            [['footnotes'], 'string', 'max' => 1000],
            [['category_id', 'expert_id', 'expert2_id', 'expert3_id'],'default','value'=>0]
        ];

        return ArrayHelper::merge(parent::rules(),$rules);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'image' => Yii::t('app', 'Image'),
            'category_id' => Yii::t('app', 'Category'),
            'expert_id' => Yii::t('app', 'Author'),
            'expert2_id' => Yii::t('app', 'Author2'),
            'expert3_id' => Yii::t('app', 'Author3'),
            'date_create' => Yii::t('app', 'Date Create'),
            'footnotes' => Yii::t('app', 'Footnotes'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    public function getExpert()
    {
        return $this->hasOne(Expert::className(), ['id' => 'expert_id']);
    }
    public function getExpert2()
    {
        return $this->hasOne(Expert::className(), ['id' => 'expert2_id']);
    }
    public function getExpert3()
    {
        return $this->hasOne(Expert::className(), ['id' => 'expert3_id']);
    }
}
