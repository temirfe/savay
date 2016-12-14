<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $image
 * @property string $date_start
 * @property string $date_end
 * @property string $place
 * @property string $latlong
 * @property string $hosted_by
 */
class Event extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules= [
            [['title'], 'required'],
            [['text'], 'string'],
            [['date_start', 'date_end'], 'safe'],
            [['title', 'description', 'place'], 'string', 'max' => 500],
            [['image'], 'string', 'max' => 200],
            [['latlong'], 'string', 'max' => 250],
            [['hosted_by'], 'string', 'max' => 255],
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
            'description' => Yii::t('app', 'Description'),
            'text' => Yii::t('app', 'Text'),
            'image' => Yii::t('app', 'Image'),
            'date_start' => Yii::t('app', 'Date Start'),
            'date_end' => Yii::t('app', 'Date End'),
            'place' => Yii::t('app', 'Place'),
            'latlong' => Yii::t('app', 'Latlong'),
            'hosted_by' => Yii::t('app', 'Hosted By'),
        ];
    }
}
