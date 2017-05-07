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
 * @property string $description
 * @property string $fact
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
            [['text','lang','description'], 'string'],
            [['category'], 'integer'],
            [['url', 'title'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 1000],
            [['image'], 'string', 'max' => 200],
            [['fact'], 'string', 'max' => 255],
        ];

        return ArrayHelper::merge(parent::rules(),$rules);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $rules=[
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'image' => Yii::t('app', 'Image'),
            'lang' => Yii::t('app', 'Language'),
            'category' => Yii::t('app', 'Category'),
            'description' => Yii::t('app', 'Description'),
            'fact' => Yii::t('app', 'Fact'),
        ];

        return ArrayHelper::merge(parent::attributeLabels(),$rules);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $dao=Yii::$app->db;
            $dao->createCommand()->update('depend', ['last_update' =>time()], 'table_name="page"')->execute();

            return true;
        } else {
            return false;
        }
    }
}
