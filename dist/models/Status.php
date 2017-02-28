<?php

namespace sonkei\status\models;

use sonkei\status\Module as StatusModule;
use yii\db\ActiveRecord as BaseModule;

/**
 * Class Status
 * @package sonkei\status\models
 *
 * @property integer $id
 * @property string $group_name
 * @property string $label
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
    function rules()
    {
        return [
            'labelRequired' => ['label', 'required'],
            'labelFilter' => ['label', 'filter', 'filter' => 'trim'],
            'labelString' => ['label', 'string', 'max' => 128],

            'groupNameRequired' => ['group_name', 'required'],
            'groupNameFilter' => ['group_name', 'filter', 'filter' => 'trim'],
            'groupNameString' => ['group_name', 'string', 'max' => 128],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'id' => StatusModule::t('core', 'ID'),
            'label' => StatusModule::t('core', 'Label'),
            'group_name' => StatusModule::t('core', 'Group name'),
        ];
    }
    #endregion

    #region Relations
    /**
     * ObjectStatus relation
     * @return \yii\db\ActiveQuery
     */
    function getObjectsStatuses()
    {
        return $this->hasMany(ObjectStatus::className(), ['status_id' => 'id']);
    }
    #endregion

    #region Events
    #endregion

    #region Methods
    /**
     * Get instance by name
     * @param string $label The label of the status
     * @return static
     */
    static function getByStatusLabel($label)
    {
        return self::findOne(['label' => $label]);
    }

    /**
     * Get available instances of the group name
     * @param string $group_name The name of the group
     * @return static[]
     */
    static function getGroupStatuses($group_name)
    {
        return self::findAll([
            'group_name' => $group_name
        ]);
    }
    #endreigon
}
