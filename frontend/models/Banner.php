<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property integer $model_id
 * @property string $model_name
 */
class Banner extends \yii\db\ActiveRecord
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
        return [
            [['model_id', 'model_name'], 'required'],
            [['model_id'], 'integer'],
            [['model_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'model_id' => Yii::t('app', 'Model ID'),
            'model_name' => Yii::t('app', 'Model Name'),
        ];
    }
}
