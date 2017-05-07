<?php
/**
 * Created by PhpStorm.
 * User: ProsoftPC
 * Date: 12/19/2016
 * Time: 4:26 PM
 */
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Banner;

/**
 * BannerSearch represents the model behind the search form about `frontend\models\Banner`.
 */
class BannerSearch extends Banner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title_ru','title_en','title_ky','title_tr'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Banner::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'title_ru'=> $this->title_ru,
            'title_en'=> $this->title_en,
            'title_ky'=> $this->title_ky,
            'title_tr'=> $this->title_tr,
        ]);

        return $dataProvider;
    }
}
