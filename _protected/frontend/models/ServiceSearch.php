<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Service;

/**
 * ServiceSearch represents the model behind the search form about `app\models\Service`.
 */
class ServiceSearch extends Service
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'created_at', 'updated_at'], 'integer'],
            [['promo','sku', 'title_en', 'title_pt', 'summary_en', 'summary_pt', 'description_en', 'description_pt', 'availability_en', 'availability_pt'], 'safe'],
            [['price'], 'number'],
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
        $query = Service::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['catName'] = [
            'asc' => ['category.name_'.Yii::$app->language => SORT_ASC],
            'desc' => ['category.name_'.Yii::$app->language => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['category']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'promo' => $this->promo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'title_pt', $this->title_pt])
            ->andFilterWhere(['like', 'summary_en', $this->summary_en])
            ->andFilterWhere(['like', 'summary_pt', $this->summary_pt])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere(['like', 'description_pt', $this->description_pt])
            ->andFilterWhere(['like', 'availability_en', $this->availability_en])
            ->andFilterWhere(['like', 'availability_pt', $this->availability_pt])
            ->andFilterWhere(['like', 'promo_txt_en', $this->promo_txt_en])
            ->andFilterWhere(['like', 'promo_txt_pt', $this->promo_txt_pt]);
        
        $query->joinWith(['category' => function ($q) {
                $q->where('category.name_'.Yii::$app->language.' LIKE "%' . $this->catName . '%"');
            }]);

        return $dataProvider;
    }
}
