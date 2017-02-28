<?php

namespace sonkei\status\models;

use sonkei\status\Module as StatusModule;
use yii\db\ActiveRecord as BaseModule;

/**
 * Class Status
 * @package sonkei\status\models
 *
 * @property integer $id
 * @property integer $priority
 * @property string $name
 * @property string $object_key
 */
class Status extends BaseModule
{
    #region Core
    /** @inheritdoc */
    static function tableName()
    {
        return '{{%status}}';
    }

    /** @inheritdoc */
    static function find($q = null)
    {
        return parent::find()->orderBy(['priority' => SORT_ASC]);
    }

    /** @inheritdoc */
    function rules()
    {
        return [
            'nameRequired' => ['name', 'required'],
            'nameFilter' => ['name', 'filter', 'filter' => 'trim'],
            'nameString' => ['name', 'string', 'max' => 45],

            'priority' => ['priority', 'integer'],

            'objectRequired' => ['object_key', 'required'],
            'objectFilter' => ['object_key', 'filter', 'filter' => 'trim'],
            'objectString' => ['object_key', 'string', 'max' => 128],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'id' => StatusModule::t('core', 'ID'),
            'priority' => StatusModule::t('core', 'Priority'),
            'name' => StatusModule::t('core', 'Name'),
            'object_key' => StatusModule::t('core', 'Object Key'),
        ];
    }
    #endregion

    #region Events
    /** @inheritdoc */
    public function beforeSave($insert)
    {
        $this->priority = self::find()
                ->andFilterWhere(['object_key' => $this->object_key])
                ->max('priority') + 1;
        return parent::beforeSave($insert);
    }
    #endregion
}
