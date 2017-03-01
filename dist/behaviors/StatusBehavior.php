<?php

namespace sonkei\status\behaviors;

use sonkei\status\models\ObjectStatus;
use sonkei\status\models\Status;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * Class StatusBehavior
 * @package sonkei\status\behaviors
 * @property ActiveRecord $owner
 */
class StatusBehavior extends Behavior
{
    #region Options
    /**
     * The name of relation
     * @var string $status_relation
     */
    public $status_relation;
    #endregion

    #region Core
    /** @inheritdoc */
    function events()
    {
        return [
            ActiveRecord::EVENT_INIT => 'afterInit'
        ];
    }
    #endregion

    #region Events
    /** @inheritdoc */
    function afterInit()
    {
        # Check if relation exist
        $this->owner->getRelation($this->status_relation);
    }
    #endregion

    #region Public methods
    /**
     * Add new status
     * @param Status $mdlStatus Status that be linked
     * @param bool $detailedResult If set TRUE result will be returned with detailed information
     * @return array|bool
     */
    function addStatus(Status $mdlStatus, $detailedResult = false)
    {
        $transaction = $this->owner::getDb()->beginTransaction();
        try {
            # If status already set, we simply return it. Otherwise try to add new status
            if (null == ($object_status = ObjectStatus::findOne(['status_id' => $mdlStatus->id, 'object_id' => $this->owner->primaryKey]))) {
                /** @var ObjectStatus $object_status */
                $object_status = Yii::createObject([
                    'class' => ObjectStatus::className(),
                    'status_id' => $mdlStatus->id,
                    'group_name' => $mdlStatus->group_name,
                    'object_id' => $this->owner->primaryKey
                ]);
                $object_status->save();
            }
            $result = !$detailedResult ? true : [
                'success' => true,
                'body' => $object_status
            ];
            $transaction->commit();
        } catch (Exception $exception) {
            $transaction->rollBack();
            $result = !$detailedResult ? false : [
                'success' => false,
                'body' => $exception
            ];
        }
        return $result;
    }

    /**
     * @param Status $status
     * @return bool
     */
    function isStatusSet(Status $status)
    {
        return array_key_exists($status->id, ArrayHelper::index($this->getAllStatuses(), 'id'));
    }

    #endregion

    #region Protected methods
    protected $statuses = [];

    /**
     * @return Status[]
     */
    function getAllStatuses()
    {
        if (!count($this->statuses)) {
            $this->statuses = $this->owner->{$this->status_relation};
        }
        return $this->statuses;
    }
    #endregion
}
