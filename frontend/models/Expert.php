<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "expert".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $email
 * @property string $phone
 * @property string $text
 * @property string $image
 * @property string $expertise_areas
 * @property string $current_positions
 * @property string $past_positions
 * @property string $education
 * @property string $cv
 * @property string $content
 */
class Expert extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules= [
            [['title'], 'required'],
            [['text','content'], 'string'],
            [['title', 'description'], 'string', 'max' => 500],
            [['email', 'phone'], 'string', 'max' => 20],
            [['image'], 'string', 'max' => 200],
            [['expertise_areas', 'current_positions', 'past_positions', 'education'], 'string', 'max' => 1000],
            [['cv'], 'string', 'max' => 100],
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
            'title' => Yii::t('app', 'Full Name'),
            'description' => Yii::t('app', 'Description'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'text' => Yii::t('app', 'Text'),
            'image' => Yii::t('app', 'Image'),
            'expertise_areas' => Yii::t('app', 'Expertise Areas'),
            'current_positions' => Yii::t('app', 'Current Positions'),
            'past_positions' => Yii::t('app', 'Past Positions'),
            'education' => Yii::t('app', 'Education'),
            'cv' => Yii::t('app', 'Upload Resume'),
            'imageFile'=>Yii::t('app', 'Image'),
            'docFiles'=>Yii::t('app', 'Upload files'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $this->content=$this->title." | ".$this->description." | ".$this->email." | ".$this->phone." | ".$this->text." | ".$this->expertise_areas." | ".$this->current_positions." | ".$this->past_positions." | ".$this->education;

            return true;
        } else {
            return false;
        }
    }
}
