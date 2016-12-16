<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "attendant".
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $fullname
 * @property string $email
 * @property string $phone
 * @property string $organization
 * @property string $job_title
 * @property string $date_create
 */
class Attendant extends \yii\db\ActiveRecord
{
    public $from_event;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attendant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'fullname', 'email', 'organization', 'job_title'], 'required'],
            [['event_id'], 'integer'],
            [['date_create','from_event'], 'safe'],
            [['fullname', 'email', 'phone', 'organization', 'job_title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'event_id' => Yii::t('app', 'Event'),
            'fullname' => Yii::t('app', 'Full Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'organization' => Yii::t('app', 'Organization'),
            'job_title' => Yii::t('app', 'Job Title'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }
}
