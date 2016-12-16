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
    public $panelist=[];
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
            [['date_start', 'date_end','panelist'], 'safe'],
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
            'imageFile' => Yii::t('app', 'Image File'),
            'date_start' => Yii::t('app', 'Date Start'),
            'date_end' => Yii::t('app', 'Date End'),
            'place' => Yii::t('app', 'Place'),
            'latlong' => Yii::t('app', 'Map link'),
            'hosted_by' => Yii::t('app', 'Hosted By'),
            'panelist'=>Yii::t('app', 'Panelist'),
        ];
    }

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);

        if($this->panelist){
            $dao=Yii::$app->db;
            $dao->createCommand()->delete('participant', ['model_name'=>'event','model_id'=>$this->id])->execute();
            foreach($this->panelist as $panelist){
                if($panelist){
                    $dao->createCommand()->insert('participant', [
                        'expert_id' => $panelist,
                        'model_name' => 'event',
                        'model_id' => $this->id,
                    ])->execute();
                }
            }
        }
    }
}
