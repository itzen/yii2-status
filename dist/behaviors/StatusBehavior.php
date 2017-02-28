<?php

namespace sonkei\status\behaviors;

use sonkei\status\models\ObjectStatus;
use sonkei\status\models\Status;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
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
     * @param Status $mdlStatus
     * @return bool
     */
    function addStatus(Status $mdlStatus)
    {
        #@todo Replace status if group_name match
        /** @var ObjectStatus $object_status */
        $object_status = Yii::createObject([
            'class' => ObjectStatus::className(),
            'status_id' => $mdlStatus->id,
            'group_name' => $mdlStatus->group_name,
            'object_id' => $this->owner->primaryKey
        ]);
        return $object_status->save();
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
