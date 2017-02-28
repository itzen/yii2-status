<?php

namespace sonkei\status\models\search;

use sonkei\status\models\Status as BaseModel;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * Class Status
 * @package sonkei\status\models\search
 */
class Status extends BaseModel
{
    #region Core
    /** @inheritdoc */
    function rules()
    {
        return [
            'nameFilter' => ['name', 'filter', 'filter' => 'trim'],
            'nameString' => ['name', 'string', 'max' => 45],

            'priority' => ['priority', 'integer'],

            'objectFilter' => ['object_key', 'filter', 'filter' => 'trim'],
            'objectString' => ['object_key', 'string', 'max' => 128],
        ];
    }

    #endregion

    #region Public methods
    /**
     * Search status models
     * @param array $params
     * @return ActiveDataProvider
     */
    function search($params)
    {
        $this->load($params);

        /** @var ActiveQuery $query */
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'priority' => $this->priority,
        ])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'object_key', $this->object_key]);

        return $dataProvider;
    }
    #endregion
}
