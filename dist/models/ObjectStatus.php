<?php
/**
 * Created by PhpStorm.
 * User: Urmat
 * Date: 28.02.2017
 * Time: 17:38
 */

namespace sonkei\status\models;

use yii\db\ActiveRecord;

/**
 * Class ObjectStatus
 * @package sonkei\status\models
 *
 * @property integer $object_id
 * @property integer $group_name
 * @property integer $status_id
 *
 * @property Status $status
 */
class ObjectStatus extends ActiveRecord
{
    #region Core
    /** @inheritdoc */
    static function tableName()
    {
        return '{{%object_status}}';
    }

    /** @inheritdoc */
    function rules()
    {
        return [
            'objectRequired' => ['object_id', 'required'],
            'objectInteger' => ['object_id', 'integer'],

            'groupNameExist' => ['group_name', 'exist', 'targetClass' => Status::className(), 'targetAttribute' => 'group_name'],

            'statusRequired' => ['status_id', 'required'],
            'statusInteger' => ['status_id', 'integer'],
            'statusExist' => ['status_id', 'exist', 'targetClass' => Status::className(), 'targetAttribute' => 'id']
        ];
    }
    #endregion

    #region Relations
    /**
     * Status relation
     * @return \yii\db\ActiveQuery
     */
    function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
    #endregion

    #region Callbacks
    /** @inheritdoc */
    function beforeSave($insert)
    {
        $this->group_name = $this->status->group_name;
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
    #endregion
}