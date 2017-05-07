<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $title_ru
 * @property string $title_en
 * @property string $title_ky
 * @property string $title_tr
 * @property string $image
 * @property string $url
 */
class Banner extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules=[
            [['title_ru','title_en','title_ky','title_tr'], 'string', 'max' => 250],
            [['url'], 'string', 'max' => 100],
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
            'title_ru' => Yii::t('app', 'Text in Russian'),
            'title_ky' => Yii::t('app', 'Text in Kyrgyz'),
            'title_tr' => Yii::t('app', 'Text in Turkish'),
            'title_en' => Yii::t('app', 'Text in English'),
            'image' => Yii::t('app', 'Image'),
            'url' => Yii::t('app', 'Url'),
        ];

        return ArrayHelper::merge(parent::attributeLabels(),$rules);
    }
}
