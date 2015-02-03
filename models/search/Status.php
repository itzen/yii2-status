<?php

namespace itzen\status\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use itzen\status\models\Status as StatusModel;

/**
 * Status represents the model behind the search form about `common\models\core\Status`.
 */
class Status extends StatusModel
{
    public function rules()
    {
        return [
            [['id', 'sortorder'], 'integer'],
            [['name', 'object_key'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = StatusModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sortorder' => $this->sortorder,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'object_key', $this->object_key]);

        return $dataProvider;
    }

    public function searchForModel($object_key)
    {
        $query = StatusModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->where([
            'object_key' => $object_key,
        ])->orWhere([
            'object_key' => null,
        ]);

        return $dataProvider;
    }
}
