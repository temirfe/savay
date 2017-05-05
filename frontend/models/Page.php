<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $text
 * @property string $image
 * @property string $lang
 * @property integer $category
 */
class Page extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules= [
            [['title'], 'required'],
            [['text','lang'], 'string'],
            [['category'], 'integer'],
            [['url', 'title'], 'string', 'max' => 20],
            [['image'], 'string', 'max' => 200],
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
            'url' => Yii::t('app', 'Url'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'image' => Yii::t('app', 'Image'),
            'lang' => Yii::t('app', 'Language'),
            'category' => Yii::t('app', 'Category'),
        ];
    }
}
