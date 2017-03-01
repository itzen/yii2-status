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
            'labelFilter' => ['label', 'filter', 'filter' => 'trim'],
            'labelString' => ['label', 'string', 'max' => 128],

            'groupNameFilter' => ['group_name', 'filter', 'filter' => 'trim'],
            'groupNameString' => ['group_name', 'string', 'max' => 128],
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
        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'group_name', $this->group_name]);

        return $dataProvider;
    }
    #endregion
}
