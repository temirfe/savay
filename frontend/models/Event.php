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
            'title' => Yii::t('app', 'Subject'),
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
    
    public function getStatus(){
        $time=time();
        $start=strtotime($this->date_start);
        $end=strtotime($this->date_end);
        $register=false;
        if($end){
            if($end<$time) {$msg=Yii::t('app','Past event');}
            else if($start<$time) {$msg=Yii::t('app','Going');}
            else {$msg=Yii::t('app','Upcoming event'); $register=true;}
        }
        else{
            if($start<$time) {$msg=Yii::t('app','Past event');}
            else {$msg=Yii::t('app','Upcoming event'); $register=true;}
        }
        return array('msg'=>$msg, 'register'=>$register);
    }
    
    public function getDates(){
        $start=strtotime($this->date_start);
        if($this->date_end){
            $end=strtotime($this->date_end);
            if(date('d-m', $start)==date('d-m', $end)){
                $start_date= Yii::$app->formatter->asDatetime($start,'EEEE, d MMMM, y H:mm');
                $end_date= " - ".Yii::$app->formatter->asTime($end,'H:mm');
            }
            else {
                $start_date= Yii::$app->formatter->asDatetime($start,'d MMMM H:mm');
                $end_date= " - ".Yii::$app->formatter->asDatetime($end,'H:mm d MMMM, y');
            }
        }
        else{
            $start_date= Yii::$app->formatter->asDatetime($start,'EEEE, d MMMM, y H:mm');
            $end_date='';
        }


        
        return ['start'=>$start_date, 'end'=>$end_date];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $dao=Yii::$app->db;
            $dao->createCommand()->update('depend', ['last_update' =>time()], 'table_name="event"')->execute();

            return true;
        } else {
            return false;
        }
    }
}
